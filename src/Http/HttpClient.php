<?php

/** @noinspection PhpDocRedundantThrowsInspection */
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;
use function GuzzleHttp\Promise\each_limit_all;

/**
 * HTTP client.
 *
 * @internal
 */
class HttpClient extends Client
{
    public const OPTION_HANDLER_RESPONSE = 'handler_response';

    public const OPTION_CACHE_TTL = 'cache_ttl';

    public const OPTION_NO_CACHE = 'no_cache';

    public const OPTION_CACHE_KEY = 'cache_key';

    /** @internal */
    private const CACHE_KEY = 'gplay.v1.%s.%s';

    /**
     * Number of attempts with HTTP error (except 404).
     *
     * @var int
     */
    private $retryLimit;

    /** @var CacheInterface|null */
    private $cache;

    /**
     * HttpClient constructor.
     *
     * @param array               $config
     * @param int                 $retryLimit
     * @param CacheInterface|null $cache
     */
    public function __construct(array $config = [], int $retryLimit = 4, ?CacheInterface $cache = null)
    {
        $this->setRetryLimit($retryLimit);
        $this->setCache($cache);

        $handlerStack = HandlerStack::create();
        $handlerStack->unshift(
            function (callable $handler) {
                return function (RequestInterface $request, array $options) use ($handler) {
                    if (!isset($options[self::OPTION_HANDLER_RESPONSE])) {
                        return $handler($request, $options);
                    }

                    if (!$options[self::OPTION_HANDLER_RESPONSE] instanceof ResponseHandlerInterface) {
                        throw new \RuntimeException(
                            "'" . self::OPTION_HANDLER_RESPONSE . "' option is not implements " . ResponseHandlerInterface::class
                        );
                    }

                    if ($this->cache !== null) {
                        if (!isset($options[self::OPTION_CACHE_KEY])) {
                            $func = $options[self::OPTION_HANDLER_RESPONSE];
                            $ref = new \ReflectionClass($func);

                            if ($ref->isAnonymous()) {
                                static $hashes;

                                if ($hashes === null) {
                                    $hashes = new \SplObjectStorage();
                                }

                                if (!isset($hashes[$func])) {
                                    try {
                                        $file = new \SplFileObject($ref->getFileName());
                                        $file->seek($ref->getStartLine() - 1);
                                        $content = '';

                                        while ($file->key() < $ref->getEndLine()) {
                                            $content .= $file->current();
                                            $file->next();
                                        }
                                        $hashes[$func] = $content;
                                    } catch (\ReflectionException $e) {
                                        throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
                                    }
                                }
                                $handlerHash = (string) $hashes[$func];
                            } else {
                                $handlerHash = $ref->getName();
                            }

                            $options[self::OPTION_CACHE_KEY] = sprintf(
                                self::CACHE_KEY,
                                hash('crc32b', $handlerHash),
                                self::getRequestHash($request)
                            );
                        }

                        $value = $this->cache->get($options[self::OPTION_CACHE_KEY]);

                        if ($value !== null) {
                            return $value;
                        }
                    }

                    return $handler($request, $options)
                        ->then(
                            function (ResponseInterface $response) use ($options, $request) {
                                $result = \call_user_func(
                                    $options[self::OPTION_HANDLER_RESPONSE],
                                    $request,
                                    $response
                                );

                                if ($this->cache !== null && $result !== null) {
                                    $ttl = $options[self::OPTION_CACHE_TTL] ?? \DateInterval::createFromDateString(
                                        '1 hour'
                                    );
                                    $noCache = $options[self::OPTION_NO_CACHE] ?? false;

                                    if (!$noCache) {
                                        $this->cache->set(
                                            $options[self::OPTION_CACHE_KEY],
                                            $result,
                                            $ttl
                                        );
                                    }
                                }

                                return $result;
                            }
                        )
                    ;
                };
            }
        );
        $handlerStack->push(
            Middleware::retry(
                function (
                    $retries,
                    /** @noinspection PhpUnusedParameterInspection */
                    RequestInterface $request,
                    ?ResponseInterface $response = null,
                    ?RequestException $exception = null
                ) {
                    // retry decider
                    if ($retries >= $this->retryLimit) {
                        return false;
                    }

                    // Retry connection exceptions
                    if ($exception instanceof ConnectException) {
                        return true;
                    }

                    if (
                        $response !== null && (
                            $response->getStatusCode() !== 404 &&
                            $response->getStatusCode() >= 400
                        )
                    ) {
                        return true;
                    }

                    return false;
                },
                static function (int $numberOfRetries) {
                    // retry delay
                    return 1000 * $numberOfRetries;
                }
            )
        );

        $config = array_replace_recursive(
            $config,
            [
                'handler' => $handlerStack,
                RequestOptions::TIMEOUT => 10.0,
                RequestOptions::COOKIES => new CookieJar(),
                RequestOptions::HEADERS => [
                    'Accept-Encoding' => 'gzip',
                    'Accept-Language' => 'en',
                    'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:67.0) Gecko/20100101 Firefox/67.0',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Connection' => 'keep-alive',
                ],
            ]
        );
        parent::__construct($config);
    }

    /**
     * @param CacheInterface|null $cache
     *
     * @return self
     */
    public function setCache(?CacheInterface $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @param string|null $proxy
     *
     * @return self
     */
    public function setProxy(?string $proxy): self
    {
        $config = $this->getConfig();
        $config[RequestOptions::PROXY] = $proxy;
        $this->setConfig($config);

        return $this;
    }

    /**
     * @param int $retryLimit
     *
     * @return self
     */
    public function setRetryLimit(int $retryLimit): self
    {
        $this->retryLimit = max(0, $retryLimit);

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return HttpClient
     */
    public function setHttpHeader(string $key, ?string $value): self
    {
        $config = $this->getConfig();

        if ($value === null) {
            if (isset($config[RequestOptions::HEADERS][$key])) {
                unset($config[RequestOptions::HEADERS][$key]);
                $this->setConfig($config);
            }
        } else {
            $config[RequestOptions::HEADERS][$key] = $value;
            $this->setConfig($config);
        }

        return $this;
    }

    /**
     * @param \DateInterval|int|null $ttl
     *
     * @return HttpClient
     */
    public function setCacheTtl($ttl): self
    {
        if ($ttl !== null && !\is_int($ttl) && !$ttl instanceof \DateInterval) {
            throw new \InvalidArgumentException('Invalid cache ttl value. Supported \DateInterval, int and null.');
        }
        $config = $this->getConfig();
        $config[self::OPTION_CACHE_TTL] = $ttl;
        $this->setConfig($config);

        return $this;
    }

    /**
     * @param float $connectTimeout
     *
     * @return HttpClient
     */
    public function setConnectTimeout(float $connectTimeout): self
    {
        if ($connectTimeout < 0) {
            throw new \InvalidArgumentException('negative connect timeout');
        }
        $config = $this->getConfig();
        $config[RequestOptions::CONNECT_TIMEOUT] = $connectTimeout;
        $this->setConfig($config);

        return $this;
    }

    /**
     * @param float $timeout
     *
     * @return HttpClient
     */
    public function setTimeout(float $timeout): self
    {
        if ($timeout < 0) {
            throw new \InvalidArgumentException('negative timeout');
        }
        $config = $this->getConfig();
        $config[RequestOptions::TIMEOUT] = $timeout;
        $this->setConfig($config);

        return $this;
    }

    /**
     * @param array $config
     */
    protected function mergeConfig(array $config): void
    {
        if (!empty($config)) {
            $this->setConfig(
                array_replace_recursive(
                    $this->getConfig(),
                    $config
                )
            );
        }
    }

    /**
     * @param array $config
     */
    protected function setConfig(array $config): void
    {
        static $property;

        try {
            if ($property === null) {
                $property = new \ReflectionProperty(parent::class, 'config');
                $property->setAccessible(true);
            }
            $property->setValue($this, $config);
        } catch (\ReflectionException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param RequestInterface $request
     *
     * @return string
     */
    private static function getRequestHash(RequestInterface $request): string
    {
        $data = [
            $request->getMethod(),
            (string) $request->getUri(),
            $request->getBody()->getContents(),
        ];

        foreach ($request->getHeaders() as $name => $header) {
            $data[] = $name . ': ' . implode(', ', $header);
        }
        $data[] = $request->getBody()->getContents();

        return hash('crc32b', implode("\n", $data));
    }

    /**
     * @param string   $method
     * @param iterable $urls
     * @param array    $options
     * @param int      $concurrency
     *
     * @throws GuzzleException
     *
     * @return array
     */
    public function requestAsyncPool(string $method, iterable $urls, array $options = [], int $concurrency = 4): array
    {
        $results = [];

        if (!$urls instanceof \Generator) {
            $urls = $this->requestGenerator($method, $urls, $options);
        }
        each_limit_all(
            $urls,
            $concurrency,
            static function ($response, $index) use (&$results): void {
                $results[$index] = $response;
            }
        )->wait();

        return $results;
    }

    /**
     * @param string   $method
     * @param iterable $urls
     * @param array    $options
     *
     * @return \Generator
     */
    private function requestGenerator(string $method, iterable $urls, array $options): \Generator
    {
        foreach ($urls as $key => $url) {
            yield $key => $this->requestAsync($method, $url, $options);
        }
    }
}
