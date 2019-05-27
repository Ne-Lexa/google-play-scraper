<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DeveloperAppsScraper extends PlayStoreUiPagesScraper
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return App[]
     * @throws GooglePlayException
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $scriptDataApps = null;
        foreach ($scriptData as $key => $scriptValue) {
            if (isset($scriptValue[0][1][0][0][3][4][2])) { // ds:3
                $scriptDataApps = $scriptValue;
            }
        }
        if ($scriptDataApps === null) {
            throw (new GooglePlayException('Error fetch cluster page'))
                ->setUrl($request->getUri()->__toString());
        }

        $developerAppsUrl = $scriptDataApps[0][1][0][0][3][4][2] ?? null;
        if ($developerAppsUrl === null) {
            return [];
        }
        $developerAppsUrl = GPlayApps::GOOGLE_PLAY_URL . $developerAppsUrl;

        $developerAppsUrl .=
            '&' . GPlayApps::REQ_PARAM_LOCALE . '=' . urlencode($this->locale) .
            '&' . GPlayApps::REQ_PARAM_COUNTRY . '=' . urlencode($this->country);

        $requestSimilar = new Request('GET', $developerAppsUrl);
        try {
            $responseSimilar = $this->httpClient->send($requestSimilar);
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
        return parent::__invoke($requestSimilar, $responseSimilar);
    }
}
