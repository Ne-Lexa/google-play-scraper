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
 * Contains detailed information about the application from the Google Play store.
 *
 * @see App Basic information about the application from the Google Play store.
 * @see GPlayApps::getAppInfo() Returns detailed information about the Android
 *     application from the Google Play store.
 * @see GPlayApps::getAppsInfo() Returns detailed information about many android packages.
 * @see GPlayApps::getAppInLocales() Returns detailed information about an application
 *     from the Google Play store for an array of locales.
 * @see GPlayApps::getAppInfoForAvailableLocales() Returns detailed information about the
 *     application in all available locales.
 */
final class AppInfo extends App
{
    /** @var string Default currency. */
    private const DEFAULT_CURRENCY = 'USD';

    /** @var string|null Application summary. */
    private $summary;

    /** @var GoogleImage|null Cover image. */
    private $cover;

    /** @var Category|null Application category. */
    private $category;

    /** @var Category|null Family category or null/ */
    private $categoryFamily;

    /** @var Video|null Promo video or null. */
    private $video;

    /** @var string|null Recent changes. */
    private $recentChanges;

    /** @var bool Editors' choice. */
    private $editorsChoice;

    /** @var int Number of application installations. */
    private $installs;

    /** @var HistogramRating Histogram rating. */
    private $histogramRating;

    /** @var float Price of the application in the Google Play store. */
    private $price;

    /** @var string Currency price of the application. */
    private $currency;

    /** @var string|null In-App Purchase price. */
    private $offersIAPCost;

    /** @var bool Application contains ads. */
    private $containsAds;

    /** @var string|null Application version, null if the application version depends on the device. */
    private $appVersion;

    /** @var string|null Android version, null if android version depends on the device. */
    private $androidVersion;

    /** @var string|null Minimum android version, null if android version depends on the device. */
    private $minAndroidVersion;

    /** @var string|null Content rating. */
    private $contentRating;

    /** @var string|null Privacy policy URL. */
    private $privacyPoliceUrl;

    /** @var \DateTimeInterface|null Release date if known. */
    private $released;

    /** @var \DateTimeInterface|null Update date or null. */
    private $updated;

    /** @var int Number of voters. */
    private $numberVoters;

    /** @var int Number of reviews. */
    private $numberReviews;

    /** @var Review[] Some useful reviews. */
    private $reviews;

    /** @var \Nelexa\GPlay\Model\Developer|null Application developer */
    private $developer;

    /**
     * Returns an object with detailed information about the application.
     *
     * @param AppBuilder $builder application builder
     *
     * @ignore
     */
    public function __construct(AppBuilder $builder)
    {
        parent::__construct($builder);

        if (empty($builder->getDescription())) {
            throw new \InvalidArgumentException(
                'Application description cannot be null or empty. Solution: $appBuilder->setDescription(...);'
            );
        }

        $this->summary = $builder->getSummary();
        $this->developer = $builder->getDeveloper();
        $this->cover = $builder->getCover();
        $this->category = $builder->getCategory();
        $this->categoryFamily = $builder->getCategoryFamily();
        $this->privacyPoliceUrl = $builder->getPrivacyPoliceUrl();
        $this->video = $builder->getVideo();
        $this->recentChanges = $builder->getRecentChanges();
        $this->editorsChoice = $builder->isEditorsChoice();
        $this->installs = $builder->getInstalls();
        $this->histogramRating = $builder->getHistogramRating()
            ?? new HistogramRating(0, 0, 0, 0, 0);
        $this->price = $builder->getPrice();
        $this->currency = $builder->getCurrency() ?? self::DEFAULT_CURRENCY;
        $this->offersIAPCost = $builder->getOffersIAPCost();
        $this->containsAds = $builder->isContainsAds();
        $this->appVersion = $builder->getAppVersion();
        $this->androidVersion = $builder->getAndroidVersion();
        $this->minAndroidVersion = $builder->getMinAndroidVersion();
        $this->contentRating = $builder->getContentRating();
        $this->released = $builder->getReleased();
        $this->updated = $builder->getUpdated();
        $this->numberVoters = $builder->getNumberVoters();
        $this->numberReviews = $builder->getNumberReviews();
        $this->reviews = $builder->getReviews();
    }

    /**
     * Returns application developer.
     *
     * @return \Nelexa\GPlay\Model\Developer|null application developer
     */
    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    public function getDeveloperName(): ?string
    {
        return $this->developer ? $this->developer->getName() : parent::getDeveloperName();
    }

    /**
     * Returns a summary of the application.
     *
     * @return string summary of the application
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @deprecated
     */
    public function isAutoTranslatedDescription(): bool
    {
        return false;
    }

    /**
     * @deprecated
     */
    public function getTranslatedFromLocale(): ?string
    {
        return null;
    }

    /**
     * Returns cover image.
     *
     * **Where it's displayed**
     * The feature graphic is displayed in front of screenshots of the application and in
     * the list of developer applications. If a promo video is added, a **Play** button
     * will overlay on the feature graphic so users can watch the promo video.
     *
     * Google Play requirements:
     * * JPEG or 24-bit PNG (no alpha)
     * * Dimensions: 1024px by 500px
     *
     * @return GoogleImage|null cover image or `null`
     *
     * @see https://support.google.com/googleplay/android-developer/answer/1078870?hl=en Graphic assets,
     *     screenshots, & video. Section **Feature graphic**.
     */
    public function getCover(): ?GoogleImage
    {
        return $this->cover;
    }

    /**
     * Returns the category of the application.
     *
     * @return Category|null category of application or `null`
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Returns family category.
     *
     * @return Category|null family category or `null`
     */
    public function getCategoryFamily(): ?Category
    {
        return $this->categoryFamily;
    }

    /**
     * Returns a video about the application.
     *
     * @return Video|null promo video or `null`
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * Returns recent changes.
     *
     * @return string|null recent changes or null if not provided
     */
    public function getRecentChanges(): ?string
    {
        return $this->recentChanges;
    }

    /**
     * Checks if the application is an editors' choice.
     *
     * @return bool `true` if the application is selected by Google Play editor, otherwise `false`
     */
    public function isEditorsChoice(): bool
    {
        return $this->editorsChoice;
    }

    /**
     * Returns the number of installations of the application.
     *
     * @return int the number of installations of the application
     */
    public function getInstalls(): int
    {
        return $this->installs;
    }

    /**
     * Returns histogram rating.
     *
     * @return HistogramRating histogram rating
     */
    public function getHistogramRating(): HistogramRating
    {
        return $this->histogramRating;
    }

    /**
     * Returns the price of the app in the Google Play store.
     *
     * @return float price or 0.00 if the app is free
     *
     * @see AppInfo::getCurrency() Returns the price currency
     *     of the app in the Google Play store.
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Returns the price currency of the app in the Google Play store.
     *
     * @return string currency price of the application, default USD
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Checks if the app contains In-App Purchases (IAP).
     *
     * @return bool `true` if the application contains AIP, and `false` if not contains
     */
    public function isContainsIAP(): bool
    {
        return $this->offersIAPCost !== null;
    }

    /**
     * Returns the cost of In-App Purchases (IAP).
     *
     * @return string|null in-App Purchase price
     */
    public function getOffersIAPCost(): ?string
    {
        return $this->offersIAPCost;
    }

    /**
     * Checks if the app contains ads.
     *
     * @return bool `true` if the application contains ads, and `false` if not contains
     */
    public function isContainsAds(): bool
    {
        return $this->containsAds;
    }

    /**
     * @deprecated
     */
    public function getSize(): ?string
    {
        return null;
    }

    /**
     * Returns the version of the application.
     *
     * @return string|null application version, `null` if the application version depends on the device
     */
    public function getAppVersion(): ?string
    {
        return $this->appVersion;
    }

    /**
     * Returns the supported version of Android.
     *
     * @return string|null android version, `null` if android version depends on the device
     */
    public function getAndroidVersion(): ?string
    {
        return $this->androidVersion;
    }

    /**
     * Returns the minimum supported version of Android.
     *
     * @return string|null minimum android version, `null` if android version depends on the device
     */
    public function getMinAndroidVersion(): ?string
    {
        return $this->minAndroidVersion;
    }

    /**
     * Returns the age limit.
     *
     * @return string|null Content rating or `null` if not provided
     */
    public function getContentRating(): ?string
    {
        return $this->contentRating;
    }

    /**
     * Returns privacy policy URL.
     *
     * @return string|null privacy policy URL
     */
    public function getPrivacyPoliceUrl(): ?string
    {
        return $this->privacyPoliceUrl;
    }

    /**
     * Returns the release date.
     *
     * @return \DateTimeInterface|null release date or `null` if not provided
     */
    public function getReleased(): ?\DateTimeInterface
    {
        return $this->released;
    }

    /**
     * Returns the date of the update.
     *
     * @return \DateTimeInterface|null update date or `null` if not provided
     */
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * Returns the number of voters.
     *
     * @return int number of voters
     */
    public function getNumberVoters(): int
    {
        return $this->numberVoters;
    }

    /**
     * Returns the number of reviews.
     *
     * @return int number of reviews
     */
    public function getNumberReviews(): int
    {
        return $this->numberReviews;
    }

    /**
     * Returns some useful reviews.
     *
     * @return Review[] some useful reviews
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /**
     * Checks for equality of applications.
     *
     * @param AppInfo $otherApp application with which is compared
     *
     * @return bool `true` if the contents of the objects being changed are the same
     *              and `false` if the objects contain different data
     *
     * @internal
     */
    public function equals(self $otherApp): bool
    {
        if ($otherApp->getId() !== $this->getId()) {
            return false;
        }

        if ($otherApp->getName() !== $this->getName()) {
            return false;
        }

        if ($otherApp->getDescription() !== $this->getDescription()) {
            return false;
        }

        if ($otherApp->recentChanges !== $this->recentChanges) {
            return false;
        }

        if ($otherApp->getIcon()->getOriginalSizeUrl() !== $this->getIcon()->getOriginalSizeUrl()) {
            return false;
        }
        $diff = array_udiff(
            $otherApp->getScreenshots(),
            $this->getScreenshots(),
            static function (GoogleImage $a, GoogleImage $b) {
                return strcmp($a->getOriginalSizeUrl(), $b->getOriginalSizeUrl());
            }
        );

        return empty($diff);
    }

    /**
     * Returns class properties as an array.
     *
     * @return array class properties as an array
     */
    public function asArray(): array
    {
        $array = parent::asArray();
        $array['cover'] = $this->cover !== null ? $this->cover->getUrl() : null;
        $array['category'] = $this->category->asArray();
        $array['categoryFamily'] = $this->categoryFamily !== null ? $this->categoryFamily->asArray() : null;
        $array['video'] = $this->video !== null ? $this->video->asArray() : null;
        $array['privacyPoliceUrl'] = $this->privacyPoliceUrl;
        $array['recentChange'] = $this->recentChanges;
        $array['editorsChoice'] = $this->editorsChoice;
        $array['installs'] = $this->installs;
        $array['numberVoters'] = $this->numberVoters;
        $array['histogramRating'] = $this->histogramRating;
        $array['price'] = $this->price;
        $array['currency'] = $this->currency;
        $array['offersIAP'] = $this->isContainsIAP();
        $array['offersIAPCost'] = $this->offersIAPCost;
        $array['containsAds'] = $this->containsAds;
        $array['appVersion'] = $this->appVersion;
        $array['androidVersion'] = $this->androidVersion;
        $array['minAndroidVersion'] = $this->minAndroidVersion;
        $array['contentRating'] = $this->contentRating;
        $array['released'] = $this->released !== null ? $this->released->format(\DateTime::RFC3339) : null;
        $array['releasedTimestamp'] = $this->released !== null ? $this->released->getTimestamp() : 0;
        $array['updated'] = $this->updated !== null ? $this->updated->format(\DateTime::RFC3339) : null;
        $array['updatedTimestamp'] = $this->updated !== null ? $this->updated->getTimestamp() : 0;
        $array['numberReviews'] = $this->numberReviews;
        $array['reviews'] = array_map(
            static function (Review $review) {
                return $review->asArray();
            },
            $this->reviews
        );

        return $array;
    }
}
