<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\Model\Builder\AppBuilder;

/**
 * Contains detailed information about the application from the Google Play store.
 *
 * @see \Nelexa\GPlay\Model\App Basic information about the application from the Google Play store.
 * @see \Nelexa\GPlay\GPlayApps::getApp() Returns detailed information about the Android
 *     application from the Google Play store.
 * @see \Nelexa\GPlay\GPlayApps::getApps() Returns detailed information about many android packages.
 * @see \Nelexa\GPlay\GPlayApps::getAppInLocales() Returns detailed information about an application
 *     from the Google Play store for an array of locales.
 * @see \Nelexa\GPlay\GPlayApps::getAppInAvailableLocales() Returns detailed information about the
 *     application in all available locales.
 */
final class AppDetail extends App
{
    /** @var string Default currency. */
    private const DEFAULT_CURRENCY = 'USD';

    /** @var string Application description. */
    private $description;

    /**
     * Locale (language) of the original description. Google automatically translates
     * the description of the application if the developer has not added it to the
     * Play Console in the "Add your own translation text" section. If a translation
     * is added, the value will be null.
     *
     * @var string|null Locale of the original description or null.
     *
     * @link https://support.google.com/googleplay/android-developer/answer/3125566
     */
    private $translatedFromLocale;

    /** @var GoogleImage|null Cover image. */
    private $cover;

    /** @var GoogleImage[] Screenshots of the application. */
    private $screenshots;

    /** @var Category Application category. */
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

    /** @var string $currency Currency price of the application. */
    private $currency;

    /** @var string|null In-App Purchase price. */
    private $offersIAPCost;

    /** @var bool Application contains ads. */
    private $containsAds;

    /** @var string|null Application size, null if the size depends on the device. */
    private $size;

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

    /**
     * Returns an object with detailed information about the application.
     *
     * @param AppBuilder $builder Application builder.
     *
     * @throws \InvalidArgumentException If not enough required data in the builder.
     *
     * @ignore
     */
    public function __construct(AppBuilder $builder)
    {
        parent::__construct($builder);

        if (empty($builder->getDescription())) {
            throw new \InvalidArgumentException('Application description cannot be null or empty. Solution: $appBuilder->setDescription(...);');
        }
        if (empty($builder->getScreenshots())) {
            throw new \InvalidArgumentException('Screenshots of the application must contain at least one screenshot. Solution: $appBuilder->setScreenshots(...); or $appBuilder->addScreenshot(...);');
        }
        if ($builder->getCategory() === null) {
            throw new \InvalidArgumentException('Application category cannot be null. Solution: $appBuilder->setCategory(...);');
        }

        $this->description = $builder->getDescription();
        $this->translatedFromLocale = $builder->getTranslatedFromLocale();
        $this->cover = $builder->getCover();
        $this->screenshots = $builder->getScreenshots();
        $this->category = $builder->getCategory();
        $this->categoryFamily = $builder->getCategoryFamily();
        $this->privacyPoliceUrl = $builder->getPrivacyPoliceUrl();
        $this->video = $builder->getVideo();
        $this->recentChanges = $builder->getRecentChanges();
        $this->editorsChoice = $builder->isEditorsChoice();
        $this->installs = $builder->getInstalls();
        $this->histogramRating = $builder->getHistogramRating() ??
            new HistogramRating(0, 0, 0, 0, 0);
        $this->price = $builder->getPrice();
        $this->currency = $builder->getCurrency() ?? self::DEFAULT_CURRENCY;
        $this->offersIAPCost = $builder->getOffersIAPCost();
        $this->containsAds = $builder->isContainsAds();
        $this->size = $builder->getSize();
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
     * Returns a description of the application.
     *
     * @return string Description of the application.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Checks if the class description is automatically translated via Google Translate.
     *
     * @return bool `true` if the description was automatically translated using Google Translate and
     *     `false` if the developer added a description for the locale in the Google Play Console.
     */
    public function isAutoTranslatedDescription(): bool
    {
        return $this->translatedFromLocale !== null;
    }

    /**
     * Returns locale (language) of the original description.
     *
     * Google automatically translates the description of the application if the developer
     * has not added it to the Play Console in the "Add your own translation text" section.
     * If a translation is added, the value will be null.
     *
     * @return string|null If the developer added a translation of the description, then the
     *     value will be `null`, otherwise the original language of the application description.
     */
    public function getTranslatedFromLocale(): ?string
    {
        return $this->translatedFromLocale;
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
     * @return GoogleImage|null Cover image or `null`.
     *
     * @see https://support.google.com/googleplay/android-developer/answer/1078870?hl=en Graphic assets,
     *     screenshots, & video. Section **Feature graphic**.
     */
    public function getCover(): ?GoogleImage
    {
        return $this->cover;
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
     * @return GoogleImage[] Array of screenshots.
     */
    public function getScreenshots(): array
    {
        return $this->screenshots;
    }

    /**
     * Returns the category of the application.
     *
     * @return Category Category of application.
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Returns family category.
     *
     * @return Category|null Family category or `null`.
     */
    public function getCategoryFamily(): ?Category
    {
        return $this->categoryFamily;
    }

    /**
     * Returns a video about the application.
     *
     * @return Video|null Promo video or `null`.
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * Returns recent changes.
     *
     * @return string|null Recent changes or null if not provided.
     */
    public function getRecentChanges(): ?string
    {
        return $this->recentChanges;
    }

    /**
     * Checks if the application is an editors' choice.
     *
     * @return bool `true` if the application is selected by Google Play editor, otherwise `false`.
     */
    public function isEditorsChoice(): bool
    {
        return $this->editorsChoice;
    }

    /**
     * Returns the number of installations of the application.
     *
     * @return int The number of installations of the application.
     */
    public function getInstalls(): int
    {
        return $this->installs;
    }

    /**
     * Returns histogram rating.
     *
     * @return HistogramRating Histogram rating.
     */
    public function getHistogramRating(): HistogramRating
    {
        return $this->histogramRating;
    }

    /**
     * Returns the price of the app in the Google Play Store.
     *
     * @return float price or 0.00 if the app is free
     *
     * @see \Nelexa\GPlay\Model\AppDetail::getCurrency() Returns the price currency
     *     of the app in the Google Play store.
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Returns the price currency of the app in the Google Play store.
     *
     * @return string Currency price of the application, default USD.
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Checks if the app contains In-App Purchases (IAP).
     *
     * @return bool `true` if the application contains AIP, and `false` if not contains.
     */
    public function isContainsIAP(): bool
    {
        return $this->offersIAPCost !== null;
    }

    /**
     * Returns the cost of In-App Purchases (IAP).
     *
     * @return string|null In-App Purchase price.
     */
    public function getOffersIAPCost(): ?string
    {
        return $this->offersIAPCost;
    }

    /**
     * Checks if the app contains ads.
     *
     * @return bool `true` if the application contains ads, and `false` if not contains.
     */
    public function isContainsAds(): bool
    {
        return $this->containsAds;
    }

    /**
     * Returns the size of the application.
     *
     * @return string|null application size, `null` if the size depends on the device
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * Returns the version of the application.
     *
     * @return string|null Application version, `null` if the application version depends on the device.
     */
    public function getAppVersion(): ?string
    {
        return $this->appVersion;
    }

    /**
     * Returns the supported version of Android.
     *
     * @return string|null Android version, `null` if android version depends on the device.
     */
    public function getAndroidVersion(): ?string
    {
        return $this->androidVersion;
    }

    /**
     * Returns the minimum supported version of Android.
     *
     * @return string|null Minimum android version, `null` if android version depends on the device.
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
     * @return string|null Privacy policy URL.
     */
    public function getPrivacyPoliceUrl(): ?string
    {
        return $this->privacyPoliceUrl;
    }

    /**
     * Returns the release date.
     *
     * @return \DateTimeInterface|null Release date or `null` if not provided.
     */
    public function getReleased(): ?\DateTimeInterface
    {
        return $this->released;
    }

    /**
     * Returns the date of the update.
     *
     * @return \DateTimeInterface|null Update date or `null` if not provided.
     */
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * Returns the number of voters.
     *
     * @return int Number of voters.
     */
    public function getNumberVoters(): int
    {
        return $this->numberVoters;
    }

    /**
     * Returns the number of reviews.
     *
     * @return int Number of reviews.
     */
    public function getNumberReviews(): int
    {
        return $this->numberReviews;
    }

    /**
     * Returns some useful reviews.
     *
     * @return Review[] Some useful reviews.
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /**
     * Checks for equality of applications.
     *
     * @param AppDetail $otherApp Application with which is compared.
     *
     * @return bool `true` if the contents of the objects being changed are the same
     *     and `false` if the objects contain different data.
     *
     * @internal
     */
    public function equals(AppDetail $otherApp): bool
    {
        if ($otherApp->getId() !== $this->getId()) {
            return false;
        }
        if ($otherApp->getName() !== $this->getName()) {
            return false;
        }
        if ($otherApp->description !== $this->description) {
            return false;
        }
        if ($otherApp->recentChanges !== $this->recentChanges) {
            return false;
        }
        if ($otherApp->getIcon()->getOriginalSizeUrl() !== $this->getIcon()->getOriginalSizeUrl()) {
            return false;
        }
        $diff = array_udiff($otherApp->screenshots, $this->screenshots, static function (GoogleImage $a, GoogleImage $b) {
            return strcmp($a->getOriginalSizeUrl(), $b->getOriginalSizeUrl());
        });
        return empty($diff);
    }

    /**
     * Returns class properties as an array.
     *
     * @return array Class properties as an array.
     */
    public function asArray(): array
    {
        $array = parent::asArray();
        $array['description'] = $this->description;
        $array['translatedFromLocale'] = $this->translatedFromLocale;
        $array['cover'] = $this->cover !== null ? $this->cover->getUrl() : null;
        $array['screenshots'] = array_map(static function (GoogleImage $googleImage) {
            return $googleImage->getUrl();
        }, $this->screenshots);
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
        $array['size'] = $this->size;
        $array['appVersion'] = $this->appVersion;
        $array['androidVersion'] = $this->androidVersion;
        $array['minAndroidVersion'] = $this->minAndroidVersion;
        $array['contentRating'] = $this->contentRating;
        $array['released'] = $this->released !== null ? $this->released->format(\DateTimeInterface::RFC3339) : null;
        $array['releasedTimestamp'] = $this->released !== null ? $this->released->getTimestamp() : 0;
        $array['updated'] = $this->updated !== null ? $this->updated->format(\DateTimeInterface::RFC3339) : null;
        $array['updatedTimestamp'] = $this->updated !== null ? $this->updated->getTimestamp() : 0;
        $array['numberReviews'] = $this->numberReviews;
        $array['reviews'] = array_map(static function (Review $review) {
            return $review->asArray();
        }, $this->reviews);
        return $array;
    }
}
