<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\Builder\DeveloperBuilder;

/**
 * Contains data on the application developer in the Google Play store.
 *
 * @see GPlayApps::getDeveloperInfo() Returns information about the
 *     developer: name, icon, cover, description and website address.
 * @see GPlayApps::getDeveloperInfoForLocales() Returns information
 *     about the developer for the locale array.
 * @see GPlayApps::getAppInfo() Returns detailed information about the
 *     Android application from the Google Play store.
 * @see GPlayApps::getAppsInfo() Returns detailed information about
 *     many android packages.
 * @see GPlayApps::getAppInLocales() Returns detailed information
 *     about an application from the Google Play store for an array of locales.
 * @see GPlayApps::getAppInfoForAvailableLocales() Returns detailed
 *     information about the application in all available locales.
 */
class Developer implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string Developer id */
    private $id;

    /** @var string url Developer page url in Google Play store */
    private $url;

    /** @var string Developer name */
    private $name;

    /** @var string|null Description of the developer */
    private $description;

    /** @var string|null Developer website */
    private $website;

    /** @var GoogleImage|null Developer icon */
    private $icon;

    /** @var GoogleImage|null Developer cover */
    private $cover;

    /** @var string|null Developer email */
    private $email;

    /** @var string|null Developer address */
    private $address;

    /**
     * Creates an object with information about the developer of Google Play.
     *
     * @param DeveloperBuilder $builder developer builder
     *
     * @internal
     */
    public function __construct(DeveloperBuilder $builder)
    {
        $this->id = $builder->getId();
        $this->url = $builder->getUrl();
        $this->name = $builder->getName();
        $this->description = $builder->getDescription();
        $this->website = $builder->getWebsite();
        $this->icon = $builder->getIcon();
        $this->cover = $builder->getCover();
        $this->email = $builder->getEmail();
        $this->address = $builder->getAddress();

        if (empty($this->id)) {
            throw new \InvalidArgumentException(
                'Developer id cannot be null or empty. ' .
                'Solution: $developerBuilder->setId(...);'
            );
        }

        if (empty($this->url)) {
            throw new \InvalidArgumentException(
                'Developer url cannot be null or empty. ' .
                'Solution: $developerBuilder->setUrl(...);'
            );
        }

        if (empty($this->name)) {
            throw new \InvalidArgumentException(
                'Developer name cannot be null or empty. ' .
                'Solution: $developerBuilder->setName(...);'
            );
        }
    }

    /**
     * Returns developer id.
     *
     * @return string developer id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns the URL of the developer’s page in Google Play.
     *
     * @return string developer page url
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Returns the name of the developer.
     *
     * @return string Developer name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns a description of the developer.
     *
     * @return string|null description of the developer or `null`
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Returns the developer's website.
     *
     * @return string|null developer website or `null`
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Returns the developer icon.
     *
     * @return GoogleImage|null developer icon or `null`
     */
    public function getIcon(): ?GoogleImage
    {
        return $this->icon;
    }

    /**
     * Returns the developer cover.
     *
     * @return GoogleImage|null developer cover or `null`
     */
    public function getCover(): ?GoogleImage
    {
        return $this->cover;
    }

    /**
     * Returns developer email.
     *
     * @return string|null developer email or `null`
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Returns the address of the developer.
     *
     * @return string|null developer address or `null`
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Creates a new developer builder.
     *
     * @return DeveloperBuilder developer builder
     *
     * @internal
     */
    public static function newBuilder(): DeveloperBuilder
    {
        return new DeveloperBuilder();
    }

    /**
     * Checks for equality of developer.
     *
     * @param Developer $otherDeveloper developer with which is compared
     *
     * @return bool `true` if the contents of the objects being changed are the same
     *              and `false` if the objects contain different data
     *
     * @internal
     */
    public function equals(self $otherDeveloper): bool
    {
        if ($this->id !== $otherDeveloper->id) {
            return false;
        }

        if ($this->name !== $otherDeveloper->name) {
            return false;
        }

        if ($this->description !== $otherDeveloper->description) {
            return false;
        }

        if ($this->icon !== null && $otherDeveloper->icon !== null) {
            if ($this->icon->getOriginalSizeUrl() !== $otherDeveloper->icon->getOriginalSizeUrl()) {
                return false;
            }
        } elseif ($this->icon !== $otherDeveloper->icon) {
            return false;
        }

        if ($this->cover !== null && $otherDeveloper->cover !== null) {
            if ($this->cover->getOriginalSizeUrl() !== $otherDeveloper->cover->getOriginalSizeUrl()) {
                return false;
            }
        } elseif ($this->cover !== $otherDeveloper->cover) {
            return false;
        }

        return true;
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
            'url' => $this->url,
            'name' => $this->name,
            'description' => $this->description,
            'website' => $this->website,
            'icon' => $this->icon !== null ? $this->icon->getUrl() : null,
            'cover' => $this->cover !== null ? $this->cover->getUrl() : null,
            'email' => $this->email,
            'address' => $this->address,
        ];
    }
}
