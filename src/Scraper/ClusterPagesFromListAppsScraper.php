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

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\HttpClient\ParseHandlerInterface;
use Nelexa\GPlay\Model\ClusterPage;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class ClusterPagesFromListAppsScraper implements ParseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $options
     *
     * @return array
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): array
    {
        $contents = $response->getBody()->getContents();
        $scriptData = ScraperUtil::extractScriptData($contents);

        if (isset($scriptData['ds:4'][0][1])) {
            $scriptDataInfo = $scriptData['ds:4'][0][1];
            $token = $scriptData['ds:4'][0][3][1] ?? null;
        } elseif (isset($scriptData['ds:3'][0][1])) {
            $scriptDataInfo = $scriptData['ds:3'][0][1];
            $token = $scriptData['ds:3'][0][3][1] ?? null;
        } else {
            return [
                'results' => [],
                'token' => null,
            ];
        }

        $results = [];

        foreach ($scriptDataInfo as $item) {
            if (isset($item[21][1][0], $item[21][1][2][4][2])) {
                $results[] = new ClusterPage(
                    trim($item[21][1][0]),
                    GPlayApps::GOOGLE_PLAY_URL . $item[21][1][2][4][2]
                );
            } elseif (isset($item[22][1][0], $item[22][1][2][4][2])) {
                $results[] = new ClusterPage(
                    trim($item[22][1][0]),
                    GPlayApps::GOOGLE_PLAY_URL . $item[22][1][2][4][2]
                );
            }
        }

        return [
            'results' => $results,
            'token' => $token,
        ];
    }
}
