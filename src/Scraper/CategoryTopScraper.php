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

namespace Nelexa\GPlay\Scraper;

use GuzzleHttp\Psr7\Query;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\HttpClient\ParseHandlerInterface;
use Nelexa\GPlay\Scraper\Extractor\AppsExtractor;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CategoryTopScraper implements ParseHandlerInterface
{
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): array
    {
        $contents = substr($response->getBody()->getContents(), 5);
        $json = \GuzzleHttp\json_decode($contents, true);
        if (empty($json[0][2])) {
            return [[], null];
        }

        $query = Query::parse($request->getUri()->getQuery());
        $locale = $query[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;
        $country = $query[GPlayApps::REQ_PARAM_COUNTRY] ?? GPlayApps::DEFAULT_COUNTRY;

        $json = \GuzzleHttp\json_decode($json[0][2], true);
        $apps = [];
        if (isset($json[0][1][0][28][0])) {
            foreach ($json[0][1][0][28][0] as $item) {
                $apps[] = AppsExtractor::extractApp($item[0], $locale, $country);
            }
        }

        return $apps;
    }
}
