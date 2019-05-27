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

class SimilarAppsScraper extends PlayStoreUiPagesScraper
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
        $similarAppsUrl = null;
        foreach ($scriptData as $key => $scriptValue) {
            if (isset($scriptValue[1][1][0][0][3][4][2])) {
                $similarAppsUrl = GPlayApps::GOOGLE_PLAY_URL . $scriptValue[1][1][0][0][3][4][2];
                break;
            }
        }

        unset($scriptData);

        if ($similarAppsUrl === null) {
            return [];
        }

        $similarAppsUrl .=
            '&' . GPlayApps::REQ_PARAM_LOCALE . '=' . urlencode($this->locale) .
            '&' . GPlayApps::REQ_PARAM_COUNTRY . '=' . urlencode($this->country);

        $requestSimilar = new Request('GET', $similarAppsUrl);
        try {
            $responseSimilar = $this->httpClient->send($requestSimilar);
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
        return parent::__invoke($requestSimilar, $responseSimilar);
    }
}
