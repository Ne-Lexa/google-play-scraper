<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Scraper\Extractor;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use function GuzzleHttp\Psr7\parse_query;

/**
 * @internal
 */
class AppsExtractor
{
    /**
     * @param array $data
     * @param string $locale
     * @param string $country
     * @return App
     */
    public static function extractApp(array $data, string $locale, string $country): App
    {
        $name = $data[2];
        $appId = $data[12][0];
        $icon = new GoogleImage($data[1][1][0][3][2]);
        $developer = self::extractDeveloper($data);
        $price = $data[7][0][3][2][1][0][2];
        $summary = $data[4][1][1][1][1];
        $score = $data[6][0][2][1][1];

        return new App(
            App::newBuilder()
                ->setId($appId)
                ->setLocale($locale)
                ->setCountry($country)
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
