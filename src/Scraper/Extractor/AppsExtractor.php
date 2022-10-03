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

namespace Nelexa\GPlay\Scraper\Extractor;

use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Util\ScraperUtil;

/**
 * @internal
 */
class AppsExtractor
{
    /**
     * @param array  $data
     * @param string $locale
     * @param string $country
     *
     * @return App
     */
    public static function extractApp(array $data, string $locale, string $country): App
    {
        $name = $data[3];
        $appId = $data[0][0];
        $icon = new GoogleImage($data[1][3][2]);
        $developerName = $data[14];
        $installsText = $data[15];
        $priceText = null;
        if (isset($data[8][1][0][0], $data[8][1][0][2]) && $data[8][1][0][0] > 0) {
            $priceText = $data[8][1][0][2];
        }
        $score = $data[4][1] ?? 0.0;
        $screenshots = array_values(array_map(static function (array $item): GoogleImage {
            return new GoogleImage($item[3][2]);
        }, array_filter($data[2], static function ($item): bool {
            return isset($item[3][2]);
        })));
        $description = ScraperUtil::html2text($data[13][1] ?? '');
        $cover = null;
        if (isset($data[22][3][2])) {
            $cover = new GoogleImage($data[22][3][2]);
        } elseif (isset($data[100][1][0][3][2])) {
            $cover = new GoogleImage($data[100][1][0][3][2]);
        }
//        $categoryName = $data[0][5];

        return App::newBuilder()
            ->setId($appId)
            ->setLocale($locale)
            ->setCountry($country)
            ->setName($name)
            ->setDeveloperName($developerName)
            ->setCover($cover)
            ->setIcon($icon)
            ->setInstallsText($installsText)
            ->setScore($score)
            ->setPriceText($priceText)
            ->setScreenshots($screenshots)
            ->setDescription($description)
            ->build()
        ;
    }

    public static function isAppStructure(array $data): bool
    {
        return
            isset(
                $data[0][0], // package id
                $data[1][3][2], // icon
                $data[3], // app name
                $data[14] // developer name
            ) && \is_string($data[0][0])
            && \is_string($data[1][3][2])
            && \is_string($data[3])
            && \is_string($data[14])
        ;
    }

    /**
     * @param mixed  $items
     * @param string $locale
     * @param string $country
     *
     * @return App[]
     */
    public static function extractApps($items, string $locale, string $country): array
    {
        $apps = [];

        if (\is_array($items)) {
            foreach ($items as $item) {
                if (self::isAppStructure($item)) {
                    $apps[] = self::extractApp($item, $locale, $country);
                } elseif (isset($item[0]) && self::isAppStructure($item[0])) {
                    $apps[] = self::extractApp($item[0], $locale, $country);
                } elseif (isset($item[0][0]) && self::isAppStructure($item[0][0])) {
                    $apps[] = self::extractApp($item[0][0], $locale, $country);
                } elseif (isset($item[0][0][0]) && self::isAppStructure($item[0][0][0])) {
                    $apps[] = self::extractApp($item[0][0][0], $locale, $country);
                }
            }
        }

        return $apps;
    }
}
