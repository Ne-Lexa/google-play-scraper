<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\HttpClient\ResponseHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class SuggestScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return string[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response): array
    {
        $contents = substr($response->getBody()->getContents(), 5);
        $json = \GuzzleHttp\json_decode($contents, true);
        $suggests = \GuzzleHttp\json_decode($json[0][2], true);

        return array_map(static function (array $suggest): string {
            return (string) $suggest[0];
        }, $suggests[0][0] ?? []);
    }
}
