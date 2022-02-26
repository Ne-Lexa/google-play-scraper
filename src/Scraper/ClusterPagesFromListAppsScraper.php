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
use Nelexa\GPlay\Model\App;
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
     * @return App[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): array
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $token = null;
        $results = [];

        foreach ($scriptData as $v) {
            if (isset($v[0][1][0][0][1], $v[0][1][0][0][3][4][2])) {
                foreach ($v[0][1] as $a) {
                    if (isset($a[0][1], $a[0][3][4][2])) {
                        $results[] = [
                            'name' => trim($a[0][1]),
                            'url' => GPlayApps::GOOGLE_PLAY_URL . $a[0][3][4][2],
                        ];
                    }
                }
                $token = $v[0][3][1] ?? null;
                break;
            }

            if (isset($v[0][1][0][20][0], $v[0][1][0][20][2][4][2])) {
                foreach ($v[0][1] as $a) {
                    if (isset($a[20][0], $a[20][2][4][2])) {
                        $results[] = [
                            'name' => trim($a[20][0]),
                            'url' => GPlayApps::GOOGLE_PLAY_URL . $a[20][2][4][2],
                        ];
                    }
                }
                $token = $v[0][3][1] ?? null;
                break;
            }
        }

        return [
            'results' => $results,
            'token' => $token,
        ];
    }
}
