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

    /** @var string|null Application summary. */
    private $summary;

    /** @var Developer Application developer. */
    private $developer;

    /** @var GoogleImage Application icon. */
    private $icon;

    /** @var float Application rating on a five-point scale. */
    private $score;

    /** @var string|null Price of the application or null if it is free. */
    private $priceText;

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

        if ($builder->getDeveloper() === null) {
            throw new \InvalidArgumentException(
                'Application developer cannot be null. Solution: $appBuilder->setDeveloper(...);'
            );
        }

        if ($builder->getIcon() === null) {
            throw new \InvalidArgumentException(
                'Application icon cannot be null. Solution: $appBuilder->setIcon(...);'
            );
        }

        parent::__construct(
            $builder->getId(),
            $builder->getLocale(),
            $builder->getCountry()
        );

        $this->name = $builder->getName();
        $this->summary = $builder->getSummary();
        $this->developer = $builder->getDeveloper();
        $this->icon = $builder->getIcon();
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
     * Returns application summary.
     *
     * @return string|null application summary
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Returns application developer.
     *
     * @return Developer application developer
     */
    public function getDeveloper(): Developer
    {
        return $this->developer;
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
            'summary' => $this->summary,
            'developer' => $this->developer->asArray(),
            'icon' => $this->icon->getUrl(),
            'score' => $this->score,
            'priceText' => $this->priceText,
        ];
    }
}
