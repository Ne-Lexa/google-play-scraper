<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

class ClusterPageScraper implements ResponseHandlerInterface, Tokenable
{
    use TokenTrait;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return App[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());
        $scriptDataInfo = null;
        foreach ($scriptData as $scriptValue) {
            if (isset($scriptValue[0][1][0][0][0]) && is_array($scriptValue[0][1][0][0][0])) {
                $scriptDataInfo = $scriptValue; // ds:3
                break;
            }
        }

        if ($scriptDataInfo === null) {
            return [];
        }

        $locale = parse_query($request->getUri()->getQuery())[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;

        $apps = [];
        foreach ($scriptDataInfo[0][1][0][0][0] as $data) {
            $name = $data[2];
            $appId = $data[12][0];
            $url = GPlayApps::GOOGLE_PLAY_URL . $data[9][4][2];
            $icon = new GoogleImage($data[1][1][0][3][2]);
            $developerName = $data[4][0][0][0];
            $developerPage = GPlayApps::GOOGLE_PLAY_URL . $data[4][0][0][1][4][2];
            $developerId = parse_query(parse_url($developerPage, PHP_URL_QUERY))[GPlayApps::REQ_PARAM_APP_ID];
            $price = $data[7][0][3][2][1][0][2] ?? null;
            $summary = $data[4][1][1][1][1];
            $score = (float) $data[6][0][2][1][1];

            $apps[] = new App(
                App::newBuilder()
                    ->setId($appId)
                    ->setUrl($url)
                    ->setLocale($locale)
                    ->setName($name)
                    ->setSummary($summary)
                    ->setDeveloper(
                        new Developer(
                            Developer::newBuilder()
                                ->setId($developerId)
                                ->setUrl($developerPage)
                                ->setName($developerName)
                        )
                    )
                    ->setIcon($icon)
                    ->setScore($score)
                    ->setPriceText($price)
            );
        }

        $this->setToken($scriptDataInfo[0][1][0][0][7][1] ?? null);

        return $apps;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
}
