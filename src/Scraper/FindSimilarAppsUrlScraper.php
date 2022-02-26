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

        foreach ($scriptData as $scriptValue) {
            if (isset($scriptValue[1][1][0][0][3][4][2])) {
                return GPlayApps::GOOGLE_PLAY_URL . $scriptValue[1][1][0][0][3][4][2]
                    . '&' . GPlayApps::REQ_PARAM_LOCALE . '=' . urlencode($this->appId->getLocale())
                    . '&' . GPlayApps::REQ_PARAM_COUNTRY . '=' . urlencode($this->appId->getCountry());
            }
        }

        return null;
    }
}
