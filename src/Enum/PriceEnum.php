<?php

/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

/*
 * Copyright (c) Ne-Lexa
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * Contains all valid values for the "price" parameter.
 *
 * @method static PriceEnum ALL()  Returns the value of the price parameter for all apps.
 * @method static PriceEnum FREE() Returns the value of the price parameter for free apps.
 * @method static PriceEnum PAID() Returns the value of the price parameter for paid apps.
 */
class PriceEnum extends Enum
{
    private const ALL = 0;

    private const FREE = 1;

    private const PAID = 2;
}
