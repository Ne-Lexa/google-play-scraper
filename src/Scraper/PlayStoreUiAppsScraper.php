<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Scraper\Extractor\AppsExtractor;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

class PlayStoreUiAppsScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response): array
    {
        $contents = substr($response->getBody()->getContents(), 5);
        $json = \GuzzleHttp\json_decode($contents, true);
        if (empty($json[0][2])) {
            return [[], null];
        }
        $json = \GuzzleHttp\json_decode($json[0][2], true);
        if (empty($json[0][0][0])) {
            return [[], null];
        }

        $locale = parse_query($request->getUri()->getQuery())[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;

        $apps = [];
        foreach ($json[0][0][0] as $data) {
            $apps[] = AppsExtractor::extractApp($data, $locale);
        }

        $nextToken = $json[0][0][7][1] ?? null;
        return [$apps, $nextToken];
    }
}
