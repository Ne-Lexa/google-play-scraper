<?php

/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * Contains all valid application collection values.
 *
 * @method static CollectionEnum TOP_FREE() Returns the collection ID for top free applications.
 * @method static CollectionEnum TOP_PAID() Returns the collection ID for top selling paid applications.
 * @method static CollectionEnum NEW_FREE() Returns the collection ID for new free applications.
 * @method static CollectionEnum NEW_PAID() Returns the collection ID for new paid applications.
 * @method static CollectionEnum GROSSING() Returns the collection ID for top-grossing applications.
 * @method static CollectionEnum TRENDING() Returns the collection ID for trend applications.
 */
class CollectionEnum extends Enum
{
    /** @var string Top Free */
    private const TOP_FREE = 'topselling_free';

    /** @var string Top Paid */
    private const TOP_PAID = 'topselling_paid';

    /** @var string Top New Free */
    private const NEW_FREE = 'topselling_new_free';

    /** @var string Top New Paid */
    private const NEW_PAID = 'topselling_new_paid';

    /** @var string Top Grossing */
    private const GROSSING = 'topgrossing';

    /** @var string Trending Apps */
    private const TRENDING = 'movers_shakers';
}
