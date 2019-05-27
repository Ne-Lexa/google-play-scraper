<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * @method static SortEnum NEWEST
 * @method static SortEnum RATING
 * @method static SortEnum HELPFULNESS
 */
class SortEnum extends Enum
{
    private const
        NEWEST = 0,
        RATING = 1,
        HELPFULNESS = 2;
}
