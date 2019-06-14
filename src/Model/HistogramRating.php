<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

/**
 * Contains application rating data as data for histogram creation.
 *
 * @see \Nelexa\GPlay\GPlayApps::getApps() Returns detailed information about
 *     many android packages.
 * @see \Nelexa\GPlay\GPlayApps::getAppInLocales() Returns detailed information
 *     about an application from the Google Play store for an array of locales.
 * @see \Nelexa\GPlay\GPlayApps::getAppInAvailableLocales() Returns detailed
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
     * @param int $fiveStars Five star app rating.
     * @param int $fourStars Four star app rating.
     * @param int $threeStars Three star app rating.
     * @param int $twoStars Two star app rating.
     * @param int $oneStar One star app rating.
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
     * @return int Five star rating app.
     */
    public function getFiveStars(): int
    {
        return $this->fiveStars;
    }

    /**
     * Returns the four-star rating of the application.
     *
     * @return int Four star rating app.
     */
    public function getFourStars(): int
    {
        return $this->fourStars;
    }

    /**
     * Returns the three-star rating of the application.
     *
     * @return int Three star rating app.
     */
    public function getThreeStars(): int
    {
        return $this->threeStars;
    }

    /**
     * Returns the two-star rating of the application.
     *
     * @return int Two star rating app.
     */
    public function getTwoStars(): int
    {
        return $this->twoStars;
    }

    /**
     * Returns the one-star rating of the application.
     *
     * @return int One star rating app.
     */
    public function getOneStar(): int
    {
        return $this->oneStar;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array Сlass properties as an array.
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
