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
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\HttpClient\ParseHandlerInterface;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class DeveloperInfoScraper implements ParseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $options
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     *
     * @return \Nelexa\GPlay\Model\Developer
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): Developer
    {
        $query = Query::parse($request->getUri()->getQuery());
        $developerId = $query[GPlayApps::REQ_PARAM_ID];
        $url = (string) $request->getUri()->withQuery(http_build_query([GPlayApps::REQ_PARAM_ID => $developerId]));

        $scriptDataInfo = $this->getScriptDataInfo($request, $response);

        $name = $scriptDataInfo[0][0][0];

        $cover = empty($scriptDataInfo[0][9][0][3][2])
            ? null
            : new GoogleImage($scriptDataInfo[0][9][0][3][2]);
        $icon = empty($scriptDataInfo[0][9][1][3][2])
            ? null
            : new GoogleImage($scriptDataInfo[0][9][1][3][2]);
        $developerSite = $scriptDataInfo[0][9][2][0][5][2] ?? null;
        $description = $scriptDataInfo[0][10][1][1] ?? '';

        return new Developer(
            Developer::newBuilder()
                ->setId($developerId)
                ->setUrl($url)
                ->setName($name)
                ->setDescription($description)
                ->setWebsite($developerSite)
                ->setIcon($icon)
                ->setCover($cover)
        );
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @throws GooglePlayException
     *
     * @return array
     */
    private function getScriptDataInfo(RequestInterface $request, ResponseInterface $response): array
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $scriptDataInfo = null;

        foreach ($scriptData as $scriptValue) {
            if (isset($scriptValue[0][21])) {
                $scriptDataInfo = $scriptValue; // ds:5
                break;
            }
        }

        if ($scriptDataInfo === null) {
            throw (new GooglePlayException(
                sprintf(
                    'Error parse vendor page %s. Need update library.',
                    $request->getUri()
                )
            ))->setUrl($request->getUri()->__toString());
        }

        return $scriptDataInfo;
    }
}
