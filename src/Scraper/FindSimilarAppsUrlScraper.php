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
use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class FindSimilarAppsUrlScraper implements ParseHandlerInterface
{
    /** @var AppId */
    private $appId;

    /**
     * SimilarScraper constructor.
     *
     * @param AppId $appId
     */
    public function __construct(AppId $appId)
    {
        $this->appId = $appId;
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $options
     *
     * @return string|null
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): ?string
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());
        $url = null;

        foreach ($scriptData as $value) {
            if (
                isset($value[1][1][1][21][1][2][4][2])
                && \is_string($value[1][1][1][21][1][2][4][2])
                && strpos($value[1][1][1][21][1][2][4][2], 'cluster') !== false
            ) {
                $url = $value[1][1][1][21][1][2][4][2];
                break;
            }
        }

        if ($url !== null) {
            return GPlayApps::GOOGLE_PLAY_URL . $url;
        }

        return null;
    }
}
