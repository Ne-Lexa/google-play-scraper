<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

/**
 * Contains application category information in the Google Play store.
 *
 * @see \Nelexa\GPlay\GPlayApps::getCategories() Returns an array of application categories
 *     from the Google Play store.
 * @see \Nelexa\GPlay\GPlayApps::getCategoriesInLocales() Returns an array of application
 *     categories from the Google Play store for the locale array.
 * @see \Nelexa\GPlay\GPlayApps::getCategoriesInAvailableLocales() Returns an array of
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
     * @param string $id Category id.
     * @param string $name Category name.
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Returns category id.
     *
     * @return string Category id.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns category name.
     *
     * @return string Category name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Checks if a category is a category with games.
     *
     * @return bool `true` if this is a category with games and `false` if not.
     */
    public function isGamesCategory(): bool
    {
        return strpos($this->id, 'GAME') === 0;
    }

    /**
     * Checks if a category is a family category.
     *
     * @return bool `true` if this is a family category and `false` if not.
     */
    public function isFamilyCategory(): bool
    {
        return strpos($this->id, 'FAMILY') === 0;
    }

    /**
     * Checks whether a category is a category with applications.
     *
     * @return bool `true` if this is a category with applications and `false` if not.
     */
    public function isApplicationCategory(): bool
    {
        return !$this->isGamesCategory() && !$this->isFamilyCategory();
    }

    /**
     * Returns class properties as an array.
     *
     * @return array Class properties as an array.
     */
    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
