<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Util\ScraperUtil;
use Nelexa\HttpClient\ResponseHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class CategoryAppsGetClusterPageScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return App[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $scriptData = $this->getClusterScriptData($response);

        return array_map(static function (array $a) {
            return [
                'name' => (string) $a[0][1],
                'url' => GPlayApps::GOOGLE_PLAY_URL . $a[0][3][4][2],
            ];
        }, $scriptData[0][1]);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function getClusterScriptData(ResponseInterface $response): array
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        foreach ($scriptData as $k => $v) {
            if (isset($v[0][1][0][0][1])) {
                return $v;
            }
        }

        throw new \RuntimeException('No script data');
    }
}
