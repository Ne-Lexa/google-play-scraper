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
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class ClusterPagesFromClusterResponseScraper implements ParseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $options
     *
     * @return string[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): array
    {
        $contents = substr($response->getBody()->getContents(), 5);
        $json = \GuzzleHttp\json_decode($contents, true);
        $json = \GuzzleHttp\json_decode($json[0][2], true);

        $results = [];
        if (isset($json[0][1]) && \is_array($json[0][1])) {
            foreach ($json[0][1] as $item) {
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
        }
        $token = $json[0][3][1] ?? null;

        return [
            'results' => $results,
            'token' => $token,
        ];
    }
}
