<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * Contains all valid values ​​for the "sort" parameter.
 *
 * @method static SortEnum HELPFULNESS() Returns the value of the sorting of reviews by helpfulness.
 * @method static SortEnum NEWEST() Returns the value of the sorting of reviews by newest.
 * @method static SortEnum RATING() Returns the value of the sorting of reviews by rating.
 */
class SortEnum extends Enum
{
    private const
        /**
         * @var int Most helpful first
         */
        HELPFULNESS = 1,
        /**
         * @var int Newest
         */
        NEWEST = 2,
        /**
         * @var int Rating
         */
        RATING = 3;
}
