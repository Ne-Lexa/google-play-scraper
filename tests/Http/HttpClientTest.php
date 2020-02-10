<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Tests\Http;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\TransferStats;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\Http\HttpClient;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class HttpClientTest extends TestCase
{
    public function testConfig(): void
    {
        $client = new HttpClient();
        self::assertArrayHasKey('Accept-Language', $client->getConfig()[RequestOptions::HEADERS]);

        $client
            ->setHttpHeader('DNT', '1')
            ->setHttpHeader(
                'User-Agent',
                'Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36'
            )
            ->setHttpHeader('Accept-Language', null)
            ->setProxy('socks5://127.0.0.1:9050')
        ;

        $config = $client->getConfig();
        self::assertSame($config[RequestOptions::HEADERS]['DNT'], '1');
        self::assertSame(
            $config[RequestOptions::HEADERS]['User-Agent'],
            'Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36'
        );
        self::assertArrayNotHasKey('Accept-Language', $config[RequestOptions::HEADERS]);
        self::assertSame($config[RequestOptions::PROXY], 'socks5://127.0.0.1:9050');

        $ttl = \DateInterval::createFromDateString('5 min');
        $client->setCacheTtl($ttl);
        self::assertSame($client->getConfig(HttpClient::OPTION_CACHE_TTL), $ttl);
    }

    public function testException(): void
    {
        $client = new HttpClient([], 0);
        $httpCode = 500;
        $url = 'https://httpbin.org/status/' . $httpCode;

        try {
            $client->request('GET', $url);
        } catch (GuzzleException $e) {
            $e = new GooglePlayException($e->getMessage(), $e->getCode(), $e);

            self::assertSame($e->getUrl(), $url);
            self::assertNotNull($e->getResponse());
            self::assertSame($e->getResponse()->getStatusCode(), $httpCode);
            $contents = $e->getResponse()->getBody()->getContents();
            self::assertEmpty($contents);
        }
    }

    /**
     * @throws GuzzleException
     */
    public function testInvalidHandlerResponseOption(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "'handler_response' option is not implements Nelexa\\GPlay\\Http\\ResponseHandlerInterface"
        );

        $client = new HttpClient();
        $client->request(
            'GET',
            'https://httpbin.org/status/200',
            [
                HttpClient::OPTION_HANDLER_RESPONSE => static function ($response) {
                    return $response;
                },
            ]
        );
    }

    public function testRetryLimit(): void
    {
        $retryLimit = 2;

        $count = 0;
        $client = new HttpClient([], $retryLimit);

        try {
            $client->request(
                'GET',
                'https://httpbin.org/status/500',
                [
                    RequestOptions::ON_STATS => static function (TransferStats $stats) use (&$count): void {
                        $response = $stats->getResponse();
                        self::assertNotNull($response);
                        self::assertEquals($response->getStatusCode(), 500);
                        $count++;
                    },
                ]
            );
        } catch (GuzzleException $e) {
        }
        self::assertEquals($count, $retryLimit + 1);
    }

    public function testRetryLimitConnectException(): void
    {
        $retryLimit = 1;

        $count = 0;
        $client = new HttpClient([], $retryLimit);

        try {
            $client->request(
                'GET',
                'https://httpbin.org/delay/3',
                [
                    RequestOptions::TIMEOUT => 1,
                    RequestOptions::ON_STATS => static function () use (&$count): void {
                        $count++;
                    },
                ]
            );
            self::fail('an exception was expected ' . ConnectException::class);
        } catch (GuzzleException $e) {
            self::assertInstanceOf(ConnectException::class, $e);
        }
        self::assertEquals($count, $retryLimit + 1);
    }

    public function testSetInvalidTtlCache(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid cache ttl value. Supported \DateInterval, int and null.');

        $client = new HttpClient();
        $client->setCacheTtl('1 day');
    }

    public function testMergeConfig(): void
    {
        $client = new class() extends HttpClient {
            public function setDebug(bool $debug): void
            {
                $this->mergeConfig([RequestOptions::DEBUG => $debug]);
            }
        };

        $debug = $client->getConfig(RequestOptions::DEBUG) ?? false;
        self::assertFalse($debug);

        $client->setDebug(true);
        self::assertTrue($client->getConfig(RequestOptions::DEBUG));
    }
}
