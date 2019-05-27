<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * @method static CollectionEnum TOP_FREE
 * @method static CollectionEnum TOP_PAID
 * @method static CollectionEnum NEW_FREE
 * @method static CollectionEnum NEW_PAID
 * @method static CollectionEnum GROSSING
 * @method static CollectionEnum TRENDING
 */
class CollectionEnum extends Enum
{
    private const
        /**
         * Top Free
         */
        TOP_FREE = 'topselling_free',
        /**
         * Top Paid
         */
        TOP_PAID = 'topselling_paid',
        /**
         * Top New Free
         */
        NEW_FREE = 'topselling_new_free',
        /**
         * Top New Paid
         */
        NEW_PAID = 'topselling_new_paid',
        /**
         * Top Grossing
         */
        GROSSING = 'topgrossing',
        /**
         * Trending Apps
         */
        TRENDING = 'movers_shakers';
}
