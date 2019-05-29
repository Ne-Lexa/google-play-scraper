<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Scraper\Extractor\AppsExtractor;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

class ClusterAppsScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response): array
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());
        $scriptDataInfo = null;
        foreach ($scriptData as $scriptValue) {
            if (isset($scriptValue[0][1][0][0][0]) && is_array($scriptValue[0][1][0][0][0])) {
                $scriptDataInfo = $scriptValue; // ds:3
                break;
            }
        }

        if ($scriptDataInfo === null) {
            return [[], null];
        }

        $locale = parse_query($request->getUri()->getQuery())[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;

        $apps = [];
        foreach ($scriptDataInfo[0][1][0][0][0] as $data) {
            $apps[] = AppsExtractor::extractApp($data, $locale);
        }

        $nextToken = $scriptDataInfo[0][1][0][0][7][1] ?? null;
        return [$apps, $nextToken];
    }
}
