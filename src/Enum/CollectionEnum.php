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
 * @method static CollectionEnum TOP_FREE()       Returns the collection ID for top free applications.
 * @method static CollectionEnum TOP_FREE_GAMES() Returns the collection ID for top free games.
 * @method static CollectionEnum TOP_PAID()       Returns the collection ID for top selling paid applications.
 * @method static CollectionEnum TOP_PAID_GAMES() Returns the collection ID for top selling paid games.
 * @method static CollectionEnum GROSSING()       Returns the collection ID for top-grossing applications.
 * @method static CollectionEnum GROSSING_GAMES() Returns the collection ID for top-grossing games.
 * @method static CollectionEnum TRENDING()       Returns the collection ID for trend applications.
 * @method static CollectionEnum NEW_FREE()       Returns the collection ID for new free applications.
 * @method static CollectionEnum NEW_FREE_GAMES() Returns the collection ID for new free games.
 * @method static CollectionEnum NEW_PAID()       Returns the collection ID for new paid applications.
 * @method static CollectionEnum NEW_PAID_GAMES() Returns the collection ID for new paid games.
 */
class CollectionEnum extends Enum
{
    private const TOP_FREE = [
        'top',
        [
            2 => 0,
            3 => 0,
            4 => 0,
            6 => 0,
        ],
    ];

    private const TOP_FREE_GAMES = [
        'top',
        [
            6 => 3,
        ],
    ];

    private const TOP_PAID = [
        'top',
        [
            2 => 1,
            3 => 1,
            4 => 3,
            6 => 1,
        ],
    ];

    private const TOP_PAID_GAMES = [
        'top',
        [
            6 => 4,
        ],
    ];

    private const GROSSING = [
        'top',
        [
            3 => 2,
            4 => 1,
            6 => 2,
        ],
    ];

    private const GROSSING_GAMES = [
        'top',
        [
            6 => 5,
        ],
    ];

    private const TRENDING = [
        'top',
        [
            4 => 2,
        ],
    ];

    private const NEW_FREE = [
        'new',
        [
            2 => 0,
            4 => 0,
        ],
    ];

    private const NEW_FREE_GAMES = [
        'new',
        [
            2 => 0,
            4 => 2,
        ],
    ];

    private const NEW_PAID = [
        'new',
        [
            2 => 1,
            4 => 1,
        ],
    ];

    private const NEW_PAID_GAMES = [
        'new',
        [
            4 => 3,
        ],
    ];

    /** @var string */
    private $path;

    /** @var array<int,int> */
    private $mapping;

    /**
     * @param array $value
     */
    protected function initValue($value): void
    {
        [
            $this->path,
            $this->mapping
        ] = $value;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param int $count
     *
     * @return int|null
     */
    public function getMappingKeyByCount(int $count): ?int
    {
        return $this->mapping[$count] ?? null;
    }
}
