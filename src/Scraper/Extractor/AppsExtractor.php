<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper\Extractor;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use function GuzzleHttp\Psr7\parse_query;

class AppsExtractor
{
    /**
     * @param array $data
     * @param string $locale
     * @return App
     */
    public static function extractApp(array $data, string $locale): App
    {
        $name = $data[2];
        $appId = $data[12][0];
        $url = GPlayApps::GOOGLE_PLAY_URL . $data[9][4][2];
        $icon = new GoogleImage($data[1][1][0][3][2]);
        $developer = self::extractDeveloper($data);
        $price = $data[7][0][3][2][1][0][2];
        $summary = $data[4][1][1][1][1];
        $score = $data[6][0][2][1][1];

        return new App(
            App::newBuilder()
                ->setId($appId)
                ->setUrl($url)
                ->setLocale($locale)
                ->setName($name)
                ->setSummary($summary)
                ->setDeveloper($developer)
                ->setIcon($icon)
                ->setScore($score)
                ->setPriceText($price)
        );
    }

    /**
     * @param array $data
     * @return Developer
     */
    private static function extractDeveloper(array $data): Developer
    {
        $developerName = $data[4][0][0][0];
        $developerPage = GPlayApps::GOOGLE_PLAY_URL . $data[4][0][0][1][4][2];
        $developerId = parse_query(parse_url($developerPage, PHP_URL_QUERY))[GPlayApps::REQ_PARAM_ID];
        $developer = new Developer(
            Developer::newBuilder()
                ->setId($developerId)
                ->setUrl($developerPage)
                ->setName($developerName)
        );
        return $developer;
    }
}
