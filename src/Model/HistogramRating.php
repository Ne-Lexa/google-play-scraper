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

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\GPlayApps;

/**
 * Contains application rating data as data for histogram creation.
 *
 * @see GPlayApps::getAppsInfo() Returns detailed information about
 *     many android packages.
 * @see GPlayApps::getAppInLocales() Returns detailed information
 *     about an application from the Google Play store for an array of locales.
 * @see GPlayApps::getAppInfoForAvailableLocales() Returns detailed
 *     information about the application in all available locales.
 */
class HistogramRating implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var int Five star app rating. */
    private $fiveStars;

    /** @var int Four star app rating. */
    private $fourStars;

    /** @var int Three star app rating. */
    private $threeStars;

    /** @var int Two star app rating. */
    private $twoStars;

    /** @var int One star app rating. */
    private $oneStar;

    /**
     * Creates an object with information about the rating of
     * Android applications from the Google Play store.
     *
     * @param int $fiveStars  five star app rating
     * @param int $fourStars  four star app rating
     * @param int $threeStars three star app rating
     * @param int $twoStars   two star app rating
     * @param int $oneStar    one star app rating
     */
    public function __construct(int $fiveStars, int $fourStars, int $threeStars, int $twoStars, int $oneStar)
    {
        $this->fiveStars = $fiveStars;
        $this->fourStars = $fourStars;
        $this->threeStars = $threeStars;
        $this->twoStars = $twoStars;
        $this->oneStar = $oneStar;
    }

    /**
     * Returns the five-star rating of the application.
     *
     * @return int five star rating app
     */
    public function getFiveStars(): int
    {
        return $this->fiveStars;
    }

    /**
     * Returns the four-star rating of the application.
     *
     * @return int four star rating app
     */
    public function getFourStars(): int
    {
        return $this->fourStars;
    }

    /**
     * Returns the three-star rating of the application.
     *
     * @return int three star rating app
     */
    public function getThreeStars(): int
    {
        return $this->threeStars;
    }

    /**
     * Returns the two-star rating of the application.
     *
     * @return int two star rating app
     */
    public function getTwoStars(): int
    {
        return $this->twoStars;
    }

    /**
     * Returns the one-star rating of the application.
     *
     * @return int one star rating app
     */
    public function getOneStar(): int
    {
        return $this->oneStar;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array Сlass properties as an array
     */
    public function asArray(): array
    {
        return [
            'five' => $this->fiveStars,
            'four' => $this->fiveStars,
            'three' => $this->threeStars,
            'two' => $this->twoStars,
            'one' => $this->oneStar,
        ];
    }
}
