<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Request\RequestApp;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class FindSimilarAppsUrlScraper implements ResponseHandlerInterface
{
    /**
     * @var RequestApp
     */
    private $requestApp;

    /**
     * SimilarScraper constructor.
     *
     * @param RequestApp $requestApp
     */
    public function __construct(RequestApp $requestApp)
    {
        $this->requestApp = $requestApp;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return string|null
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response): ?string
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());
        foreach ($scriptData as $key => $scriptValue) {
            if (isset($scriptValue[1][1][0][0][3][4][2])) {
                return GPlayApps::GOOGLE_PLAY_URL . $scriptValue[1][1][0][0][3][4][2] .
                    '&' . GPlayApps::REQ_PARAM_LOCALE . '=' . urlencode($this->requestApp->getLocale()) .
                    '&' . GPlayApps::REQ_PARAM_COUNTRY . '=' . urlencode($this->requestApp->getCountry());
                break;
            }
        }
        return null;
    }
}
