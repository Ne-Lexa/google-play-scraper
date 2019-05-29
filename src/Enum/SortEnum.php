<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * @method static SortEnum HELPFULNESS
 * @method static SortEnum NEWEST
 * @method static SortEnum RATING
 */
class SortEnum extends Enum
{
    private const
        /**
         * Most helpful first
         */
        HELPFULNESS = 1,
        /**
         * Newest
         */
        NEWEST = 2,
        /**
         * Rating
         */
        RATING = 3;
}
