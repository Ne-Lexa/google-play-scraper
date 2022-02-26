<?php

declare(strict_types=1);

/*
 * Copyright (c) Ne-Lexa
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\GPlayApps;

/**
 * Contains application category information in the Google Play store.
 *
 * @see GPlayApps::getCategories() Returns an array of application categories
 *     from the Google Play store.
 * @see GPlayApps::getCategoriesForLocales() Returns an array of application
 *     categories from the Google Play store for the locale array.
 * @see GPlayApps::getCategoriesForAvailableLocales() Returns an array of
 *     categories from the Google Play store for all available locales.
 */
class Category implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string Category id. */
    private $id;

    /** @var string Category name. */
    private $name;

    /**
     * Creates an object with application category information.
     *
     * @param string $id   category id
     * @param string $name category name
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Returns category id.
     *
     * @return string category id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns category name.
     *
     * @return string category name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Checks if a category is a category with games.
     *
     * @return bool `true` if this is a category with games and `false` if not
     */
    public function isGamesCategory(): bool
    {
        return strpos($this->id, 'GAME') === 0;
    }

    /**
     * Checks if a category is a family category.
     *
     * @return bool `true` if this is a family category and `false` if not
     */
    public function isFamilyCategory(): bool
    {
        return strpos($this->id, 'FAMILY') === 0;
    }

    /**
     * Checks whether a category is a category with applications.
     *
     * @return bool `true` if this is a category with applications and `false` if not
     */
    public function isApplicationCategory(): bool
    {
        return !$this->isGamesCategory() && !$this->isFamilyCategory();
    }

    /**
     * Returns class properties as an array.
     *
     * @return array class properties as an array
     */
    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
