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
    private const
        /**
         * @var string Top Free
         */
        TOP_FREE = 'topselling_free';

    private const

        /**
         * @var string Top Paid
         */
        TOP_PAID = 'topselling_paid';

    private const

        /**
         * @var string Top New Free
         */
        NEW_FREE = 'topselling_new_free';

    private const

        /**
         * @var string Top New Paid
         */
        NEW_PAID = 'topselling_new_paid';

    private const

        /**
         * @var string Top Grossing
         */
        GROSSING = 'topgrossing';

    private const

        /**
         * @var string Trending Apps
         */
        TRENDING = 'movers_shakers';
}
