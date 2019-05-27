<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

class PlayStoreUiScraper implements ResponseHandlerInterface, Tokenable
{
    use TokenTrait;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return App[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $body = $response->getBody();
        $body->rewind();
        $contents = substr($body->getContents(), 5);
        $json = \GuzzleHttp\json_decode($contents, true);
        $json = \GuzzleHttp\json_decode($json[0][2], true);

        $locale = parse_query($request->getUri()->getQuery())[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;

        $apps = [];
        foreach ($json[0][0][0] as $data) {
            $name = $data[2];
            $appId = $data[12][0];
            $url = GPlayApps::GOOGLE_PLAY_URL . $data[9][4][2];
            $icon = new GoogleImage($data[1][1][0][3][2]);
            $developerName = $data[4][0][0][0];
            $developerPage = GPlayApps::GOOGLE_PLAY_URL . $data[4][0][0][1][4][2];
            $developerId = parse_query(parse_url($developerPage, PHP_URL_QUERY))['id'];
            $price = $data[7][0][3][2][1][0][2];
            $summary = $data[4][1][1][1][1];
            $score = $data[6][0][2][1][1];

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

        $this->setToken($json[0][0][7][1] ?? null);

        return $apps;
    }
}
