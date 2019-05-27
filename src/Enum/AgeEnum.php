<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * @method static AgeEnum FIVE_UNDER
 * @method static AgeEnum SIX_EIGHT
 * @method static AgeEnum NINE_UP
 */
class AgeEnum extends Enum
{
    private const
        /**
         * Ages 5 and under
         */
        FIVE_UNDER = 'AGE_RANGE1',
        /**
         * Ages 6-8
         */
        SIX_EIGHT = 'AGE_RANGE2',
        /**
         * Ages 9 & Up
         */
        NINE_UP = 'AGE_RANGE3';
}
