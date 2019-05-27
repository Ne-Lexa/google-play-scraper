<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * @method static PriceEnum ALL
 * @method static PriceEnum FREE
 * @method static PriceEnum PAID
 */
class PriceEnum extends Enum
{
    private const
        ALL = 0,
        FREE = 1,
        PAID = 2;
}
