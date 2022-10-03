<?php

declare(strict_types=1);

/*
 * Copyright (c) Ne-Lexa
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\HttpClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Pool;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class HttpClient
{
    public const DEFAULT_CONCURRENCY = 4;

    /** @var \Psr\SimpleCache\CacheInterface|null */
    private $cache;

    /** @var \GuzzleHttp\Client */
    private $client;

    /** @var array */
    private $options = [];

    public function __construct(?GuzzleClient $client = null, ?CacheInterface $cache = null)
    {
        if ($client === null) {
            $proxy = getenv('HTTP_PROXY');

            $defaultOptions = [
                RequestOptions::HEADERS => [
                    'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0',
                ],
            ];

            if ($proxy !== false) {
                $defaultOptions[RequestOptions::PROXY] = $proxy;
            }

            $stack = HandlerStack::create();
            if (\PHP_SAPI === 'cli') {
                $logTemplate = $config['logTemplate']
                    ?? '🌎 [{ts}] "{method} {url} HTTP/{version}" {code} "{phrase}" - {res_header_Content-Length}';
                $stack->push(Middleware::log(new ConsoleLog(), new MessageFormatter($logTemplate)), 'logger');
            }
            $stack->push(
                Middleware::retry(
                    static function (
                        int $retries,
                        RequestInterface $request,
                        ?ResponseInterface $response = null,
                        ?TransferException $exception = null
                    ) {
                        return $retries < 3 && (
                            $exception instanceof ConnectException
                                || (
                                    $response !== null
                                    && \in_array($response->getStatusCode(), [408, 429, 500, 502, 503, 522], true)
                                )
                        );
                    },
                    static function (int $retries) {
                        return 2 ** $retries * 1000;
                    }
                ),
                'retry'
            );
            $defaultOptions['handler'] = $stack;

            $client = new GuzzleClient($defaultOptions);
        }

        $this->client = $client;
        $this->cache = $cache;
    }

    /**
     * @return \Psr\SimpleCache\CacheInterface|null
     */
    public function getCache(): ?CacheInterface
    {
        return $this->cache;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient(): GuzzleClient
    {
        return $this->client;
    }

    /**
     * @param \Nelexa\GPlay\HttpClient\Request $request
     * @param \Closure|null                    $onRejected
     *
     * @return mixed
     */
    public function request(Request $request, ?\Closure $onRejected = null)
    {
        $promise = $this->getRequestPromise($request);
        $promise->otherwise(
            $onRejected ?? static function (\Throwable $throwable) {
                return $throwable;
            }
        );

        return $promise->wait();
    }

    /**
     * @param \Nelexa\GPlay\HttpClient\Request $request
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @internal
     */
    public function getRequestPromise(Request $request): PromiseInterface
    {
        $options = array_merge($this->options, $request->getOptions());
        $cacheKey = null;

        if (
            $this->cache !== null
            && !\array_key_exists('no_cache', $options)
            && \array_key_exists('cache_ttl', $options)
        ) {
            $cacheKey = $options['cache_key'] ?? sprintf(
                'http_client_gplay.v1.%s.%s',
                HashUtil::hashCallable($request->getParseHandler()),
                HashUtil::getRequestHash($request->getPsrRequest())
            );
            try {
                $cachedValue = $this->cache->get($cacheKey);
            } catch (InvalidArgumentException $e) {
                throw new \RuntimeException('Error fetch cache');
            }

            if ($cachedValue !== null) {
                return new FulfilledPromise($cachedValue);
            }
        }

        return $this->client
            ->sendAsync($request->getPsrRequest(), $request->getOptions())
            ->then(function (ResponseInterface $response) use ($request, $cacheKey, $options) {
                $parseResult = $request->getParseHandler()($request->getPsrRequest(), $response, $options);
                if ($cacheKey !== null && $parseResult !== null) {
                    $this->cache->set($cacheKey, $parseResult, $options['cache_ttl']);
                }

                return $parseResult;
            })
        ;
    }

    /**
     * @param array<Request> $requests
     * @param \Closure|null  $onRejected
     *
     * @return array
     */
    public function requestPool(array $requests, ?\Closure $onRejected = null): array
    {
        $makeRequests = function () use ($requests): \Generator {
            foreach ($requests as $key => $request) {
                yield $key => function () use ($request): PromiseInterface {
                    return $this->getRequestPromise($request);
                };
            }
        };

        $results = [];
        $pool = new Pool($this->client, $makeRequests(), [
            'concurrency' => $options['concurrency'] ?? self::DEFAULT_CONCURRENCY,
            'fulfilled' => static function ($result, $key) use (&$results): void {
                $results[$key] = $result;
            },
            'rejected' => $onRejected ?? static function (\Throwable $throwable, $key): void {
                throw $throwable;
            },
        ]);

        $pool->promise()->wait();

        return $results;
    }

    /**
     * @param \Psr\SimpleCache\CacheInterface|null $cache
     *
     * @return HttpClient
     */
    public function setCache(?CacheInterface $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @param \GuzzleHttp\Client $client
     *
     * @return HttpClient
     */
    public function setClient(GuzzleClient $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function setOption(string $key, $value): self
    {
        $this->options[$key] = $value;

        return $this;
    }

    public function setConcurrency(int $concurrency): self
    {
        $this->options['concurrency'] = max(1, $concurrency);

        return $this;
    }

    public function getConcurrency(): int
    {
        return $this->options['concurrency'] ?? self::DEFAULT_CONCURRENCY;
    }

    public function setConnectTimeout(float $connectTimeout): self
    {
        $this->options[RequestOptions::CONNECT_TIMEOUT] = max(0, $connectTimeout);

        return $this;
    }

    public function setTimeout(float $timeout): self
    {
        $this->options[RequestOptions::TIMEOUT] = max(0, $timeout);

        return $this;
    }
}
