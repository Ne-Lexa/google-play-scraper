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
use Nelexa\GPlay\Model\Builder\AppBuilder;

/**
 * Contains basic information about the application from the Google Play store.
 *
 * Some sections, such as search, similar applications, applications categories, etc. display
 * a list of applications with limited data. To get detailed information about the application,
 * you must call the appropriate method in the class {@see GPlayApps}.
 *
 * @see AppId Application ID, application locale and country.
 * @see GPlayApps::search() Returns a list of applications from the Google Play
 *     store for a search query.
 * @see GPlayApps::getSimilarApps() Returns a list of similar applications in
 *     the Google Play store.
 * @see GPlayApps::getDeveloperApps() Returns a list of developer applications
 *     in the Google Play store.
 * @see GPlayApps::getTopApps() Returns a list of applications with basic
 *     information from the category and collection of the Google Play store.
 */
class App extends AppId implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string Application name. */
    private $name;

    /** @var string Application description. */
    private $description;

    /** @var string|null Application developer name. */
    private $developerName;

    /** @var GoogleImage Application icon. */
    private $icon;

    /** @var GoogleImage[] Screenshots of the application. */
    private $screenshots;

    /** @var float Application rating on a five-point scale. */
    private $score;

    /** @var string|null Price of the application or null if it is free. */
    private $priceText;

    /** @var string Formatted number of installations of the application. */
    private $installsText;

    /**
     * Creates an object containing basic information about the Android application.
     *
     * @param AppBuilder $builder application builder
     *
     * @ignore
     */
    public function __construct(AppBuilder $builder)
    {
        if (empty($builder->getId())) {
            throw new \InvalidArgumentException(
                'Application ID cannot be null or empty. Solution: $appBuilder->setId(...);'
            );
        }

        if (empty($builder->getLocale())) {
            throw new \InvalidArgumentException(
                'Locale cannot be null or empty. Solution: $appBuilder->setLocale(...);'
            );
        }

        if (empty($builder->getCountry())) {
            throw new \InvalidArgumentException(
                'Country cannot be null or empty. Solution: $appBuilder->setCountry(...);'
            );
        }

        if (empty($builder->getName())) {
            throw new \InvalidArgumentException(
                'The application name cannot be null or empty. Solution: $appBuilder->setName(...);'
            );
        }

        if ($builder->getIcon() === null) {
            throw new \InvalidArgumentException(
                'Application icon cannot be null. Solution: $appBuilder->setIcon(...);'
            );
        }

        if (empty($builder->getScreenshots())) {
            throw new \InvalidArgumentException(
                'Screenshots of the application must contain at least one screenshot. Solution: $appBuilder->setScreenshots(...); or $appBuilder->addScreenshot(...);'
            );
        }

        parent::__construct(
            $builder->getId(),
            $builder->getLocale(),
            $builder->getCountry()
        );

        $this->name = $builder->getName();
        $this->description = $builder->getDescription();
        $this->developerName = $builder->getDeveloperName();
        $this->installsText = $builder->getInstallsText();
        $this->icon = $builder->getIcon();
        $this->screenshots = $builder->getScreenshots();
        $this->score = $builder->getScore();
        $this->priceText = $builder->getPriceText();
    }

    /**
     * Returns application name.
     *
     * @return string application name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns a description of the application.
     *
     * @return string description of the application
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Returns application summary.
     *
     * @return string|null application summary
     *
     * @deprecated It is no longer possible to get a summary
     */
    public function getSummary(): ?string
    {
        return null;
    }

    /**
     * Returns application developer.
     *
     * @return Developer|null application developer
     *
     * @deprecated Use {@see \Nelexa\GPlay\Model\App::getDeveloperName()}
     */
    public function getDeveloper(): ?Developer
    {
        return null;
    }

    /**
     * Returns application developer name.
     *
     * @return string|null application developer name
     */
    public function getDeveloperName(): ?string
    {
        return $this->developerName;
    }

    /**
     * Returns application icon.
     *
     * @return GoogleImage application icon
     */
    public function getIcon(): GoogleImage
    {
        return $this->icon;
    }

    /**
     * Returns screenshots of the application.
     *
     * The array must contain at least 2 screenshots.
     *
     * Google Play screenshots requirements:
     * * JPEG or 24-bit PNG (no alpha)
     * * Minimum dimension: 320px
     * * Maximum dimension: 3840px
     * * The maximum dimension of the screenshot can't be more than twice as long as the minimum dimension.
     *
     * @return GoogleImage[] array of screenshots
     */
    public function getScreenshots(): array
    {
        return $this->screenshots;
    }

    /**
     * Returns application rating on a five-point scale.
     *
     * @return float rating application
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * Returns the price of the application.
     *
     * @return string|null application price or null if it is free
     */
    public function getPriceText(): ?string
    {
        return $this->priceText;
    }

    /**
     * Checks that this application is free.
     *
     * @return bool `true` if the application is free and `false` if paid
     */
    public function isFree(): bool
    {
        return $this->priceText === null;
    }

    /**
     * @return string
     */
    public function getInstallsText(): ?string
    {
        return $this->installsText;
    }

    /**
     * Creates a new application builder.
     *
     * @return AppBuilder application builder
     * @ignore
     */
    public static function newBuilder(): AppBuilder
    {
        return new AppBuilder();
    }

    /**
     * Returns class properties as an array.
     *
     * @return array class properties as an array
     */
    public function asArray(): array
    {
        return [
            'id' => $this->getId(),
            'url' => $this->getUrl(),
            'locale' => $this->getLocale(),
            'country' => $this->getCountry(),
            'name' => $this->name,
            'description' => $this->description,
            'developerName' => $this->getDeveloperName(),
            'icon' => $this->icon->getUrl(),
            'screenshots' => array_map(
                static function (GoogleImage $googleImage) {
                    return $googleImage->getUrl();
                },
                $this->screenshots
            ),
            'score' => $this->score,
            'priceText' => $this->priceText,
            'installsText' => $this->installsText,
        ];
    }
}
