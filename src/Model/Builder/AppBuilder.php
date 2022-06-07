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

namespace Nelexa\GPlay\Model\Builder;

use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\AppInfo;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\HistogramRating;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Model\Video;

/**
 * App Builder.
 *
 * @internal
 */
class AppBuilder
{
    /** @var string|null */
    private $id;

    /** @var string|null */
    private $locale;

    /** @var string|null */
    private $country;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $summary;

    /** @var Developer|null */
    private $developer;

    /** @var string|null */
    private $developerName;

    /** @var GoogleImage|null */
    private $icon;

    /** @var float */
    private $score = 0.0;

    /** @var string|null */
    private $priceText;

    /** @var string|null */
    private $description;

    /** @var GoogleImage|null */
    private $cover;

    /** @var GoogleImage[] */
    private $screenshots = [];

    /** @var Category|null */
    private $category;

    /** @var string|null */
    private $privacyPoliceUrl;

    /** @var Category|null */
    private $categoryFamily;

    /** @var Video|null */
    private $video;

    /** @var string|null */
    private $recentChanges;

    /** @var bool */
    private $editorsChoice = false;

    /** @var int */
    private $installs = 0;

    /** @var string|null */
    private $installsText;

    /** @var int */
    private $numberVoters = 0;

    /** @var HistogramRating|null */
    private $histogramRating;

    /** @var float */
    private $price = 0;

    /** @var string|null */
    private $currency;

    /** @var string|null */
    private $offersIAPCost;

    /** @var bool */
    private $containsAds = false;

    /** @var string|null */
    private $appVersion;

    /** @var string|null */
    private $androidVersion;

    /** @var string|null */
    private $minAndroidVersion;

    /** @var string|null */
    private $contentRating;

    /** @var \DateTimeInterface|null */
    private $released;

    /** @var \DateTimeInterface|null */
    private $updated;

    /** @var int */
    private $numberReviews = 0;

    /** @var Review[] */
    private $reviews = [];

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return AppBuilder
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string|null $locale
     *
     * @return AppBuilder
     */
    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     *
     * @return AppBuilder
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return AppBuilder
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     *
     * @return AppBuilder
     */
    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return Developer|null
     */
    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    /**
     * @param Developer|null $developer
     *
     * @return AppBuilder
     */
    public function setDeveloper(?Developer $developer): self
    {
        $this->developer = $developer;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeveloperName(): ?string
    {
        return $this->developerName;
    }

    /**
     * @param string|null $developerName
     *
     * @return AppBuilder
     */
    public function setDeveloperName(?string $developerName): self
    {
        $this->developerName = $developerName;

        return $this;
    }

    /**
     * @return GoogleImage|null
     */
    public function getIcon(): ?GoogleImage
    {
        return $this->icon;
    }

    /**
     * @param GoogleImage|null $icon
     *
     * @return AppBuilder
     */
    public function setIcon(?GoogleImage $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     *
     * @return AppBuilder
     */
    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPriceText(): ?string
    {
        return $this->priceText;
    }

    /**
     * @param string|null $priceText
     *
     * @return AppBuilder
     */
    public function setPriceText(?string $priceText): self
    {
        if ($priceText === '') {
            $priceText = null;
        }
        $this->priceText = $priceText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return AppBuilder
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return GoogleImage|null
     */
    public function getCover(): ?GoogleImage
    {
        return $this->cover;
    }

    /**
     * @param GoogleImage|null $cover
     *
     * @return AppBuilder
     */
    public function setCover(?GoogleImage $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return GoogleImage[]
     */
    public function getScreenshots(): array
    {
        return $this->screenshots;
    }

    /**
     * @param GoogleImage[] $screenshots
     *
     * @return AppBuilder
     */
    public function setScreenshots(array $screenshots): self
    {
        $this->screenshots = [];

        foreach ($screenshots as $screenshot) {
            $this->addScreenshot($screenshot);
        }

        return $this;
    }

    /**
     * @param GoogleImage $image
     *
     * @return AppBuilder
     */
    public function addScreenshot(GoogleImage $image): self
    {
        $this->screenshots[] = $image;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     *
     * @return AppBuilder
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrivacyPoliceUrl(): ?string
    {
        return $this->privacyPoliceUrl;
    }

    /**
     * @param string|null $privacyPoliceUrl
     *
     * @return AppBuilder
     */
    public function setPrivacyPoliceUrl(?string $privacyPoliceUrl): self
    {
        $this->privacyPoliceUrl = $privacyPoliceUrl;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategoryFamily(): ?Category
    {
        return $this->categoryFamily;
    }

    /**
     * @param Category|null $categoryFamily
     *
     * @return AppBuilder
     */
    public function setCategoryFamily(?Category $categoryFamily): self
    {
        $this->categoryFamily = $categoryFamily;

        return $this;
    }

    /**
     * @return Video|null
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @param Video|null $video
     *
     * @return AppBuilder
     */
    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecentChanges(): ?string
    {
        return $this->recentChanges;
    }

    /**
     * @param string|null $recentChanges
     *
     * @return AppBuilder
     */
    public function setRecentChanges(?string $recentChanges): self
    {
        $this->recentChanges = $recentChanges;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEditorsChoice(): bool
    {
        return $this->editorsChoice;
    }

    /**
     * @param bool $editorsChoice
     *
     * @return AppBuilder
     */
    public function setEditorsChoice(bool $editorsChoice): self
    {
        $this->editorsChoice = $editorsChoice;

        return $this;
    }

    /**
     * @return int
     */
    public function getInstalls(): int
    {
        return $this->installs;
    }

    /**
     * @param int $installs
     *
     * @return AppBuilder
     */
    public function setInstalls(int $installs): self
    {
        $this->installs = $installs;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInstallsText(): ?string
    {
        return $this->installsText;
    }

    /**
     * @param string|null $installsText
     *
     * @return AppBuilder
     */
    public function setInstallsText(?string $installsText): self
    {
        $this->installsText = $installsText;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumberVoters(): int
    {
        return $this->numberVoters;
    }

    /**
     * @param int $numberVoters
     *
     * @return AppBuilder
     */
    public function setNumberVoters(int $numberVoters): self
    {
        $this->numberVoters = $numberVoters;

        return $this;
    }

    /**
     * @return HistogramRating|null
     */
    public function getHistogramRating(): ?HistogramRating
    {
        return $this->histogramRating;
    }

    /**
     * @param HistogramRating|null $histogramRating
     *
     * @return AppBuilder
     */
    public function setHistogramRating(?HistogramRating $histogramRating): self
    {
        $this->histogramRating = $histogramRating;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return AppBuilder
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     *
     * @return AppBuilder
     */
    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOffersIAPCost(): ?string
    {
        return $this->offersIAPCost;
    }

    /**
     * @param string|null $offersIAPCost
     *
     * @return AppBuilder
     */
    public function setOffersIAPCost(?string $offersIAPCost): self
    {
        $this->offersIAPCost = $offersIAPCost;

        return $this;
    }

    /**
     * @return bool
     */
    public function isContainsAds(): bool
    {
        return $this->containsAds;
    }

    /**
     * @param bool $containsAds
     *
     * @return AppBuilder
     */
    public function setContainsAds(bool $containsAds): self
    {
        $this->containsAds = $containsAds;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAppVersion(): ?string
    {
        return $this->appVersion;
    }

    /**
     * @param string|null $appVersion
     *
     * @return AppBuilder
     */
    public function setAppVersion(?string $appVersion): self
    {
        $this->appVersion = $appVersion;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAndroidVersion(): ?string
    {
        return $this->androidVersion;
    }

    /**
     * @param string|null $androidVersion
     *
     * @return AppBuilder
     */
    public function setAndroidVersion(?string $androidVersion): self
    {
        $this->androidVersion = $androidVersion;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMinAndroidVersion(): ?string
    {
        return $this->minAndroidVersion;
    }

    /**
     * @param string|null $minAndroidVersion
     *
     * @return AppBuilder
     */
    public function setMinAndroidVersion(?string $minAndroidVersion): self
    {
        $this->minAndroidVersion = $minAndroidVersion;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContentRating(): ?string
    {
        return $this->contentRating;
    }

    /**
     * @param string|null $contentRating
     *
     * @return AppBuilder
     */
    public function setContentRating(?string $contentRating): self
    {
        $this->contentRating = $contentRating;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getReleased(): ?\DateTimeInterface
    {
        return $this->released;
    }

    /**
     * @param \DateTimeInterface|null $released
     *
     * @return AppBuilder
     */
    public function setReleased(?\DateTimeInterface $released): self
    {
        $this->released = $released;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * @param \DateTimeInterface|null $updated
     *
     * @return AppBuilder
     */
    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumberReviews(): int
    {
        return $this->numberReviews;
    }

    /**
     * @param int $numberReviews
     *
     * @return AppBuilder
     */
    public function setNumberReviews(int $numberReviews): self
    {
        $this->numberReviews = $numberReviews;

        return $this;
    }

    /**
     * @return Review[]
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /**
     * @param Review[] $reviews
     *
     * @return AppBuilder
     */
    public function setReviews(array $reviews): self
    {
        $this->reviews = [];

        foreach ($reviews as $review) {
            $this->addReview($review);
        }

        return $this;
    }

    /**
     * @param Review $review
     *
     * @return AppBuilder
     */
    public function addReview(Review $review): self
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * @return App
     */
    public function build(): App
    {
        return new App($this);
    }

    /**
     * @return AppInfo
     */
    public function buildDetailInfo(): AppInfo
    {
        return new AppInfo($this);
    }
}
