<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\Model\Builder\AppBuilder;

class AppDetail extends App
{
    /**
     * @var string
     */
    private $description;
    /**
     * @var string|null
     */
    private $translatedDescription;
    /**
     * @var string|null
     */
    private $translatedFromLanguage;
    /**
     * @var GoogleImage|null
     */
    private $headerImage;
    /**
     * @var GoogleImage[]
     */
    private $screenshots;
    /**
     * @var Category
     */
    private $category;
    /**
     * @var string|null
     */
    private $privacyPoliceUrl;
    /**
     * @var Category|null
     */
    private $categoryFamily;
    /**
     * @var Video|null
     */
    private $video;
    /**
     * @var string|null
     */
    private $recentChanges;
    /**
     * @var bool
     */
    private $editorsChoice;
    /**
     * @var int
     */
    private $installs;
    /**
     * @var int
     */
    private $numberVoters;
    /**
     * @var HistogramRating
     */
    private $histogramRating;
    /**
     * @var float
     */
    private $price;
    /**
     * @var string
     */
    private $currency;
    /**
     * Offers in-app purchases
     *
     * @var string|null
     */
    private $offersIAPCost;
    /**
     * @var bool
     */
    private $adSupported;
    /**
     * @var string|null
     */
    private $appSize;
    /**
     * @var string|null
     */
    private $appVersion;
    /**
     * @var string|null
     */
    private $androidVersion;
    /**
     * @var string|null
     */
    private $minAndroidVersion;
    /**
     * @var string|null
     */
    private $contentRating;
    /**
     * @var \DateTimeInterface|null
     */
    private $released;
    /**
     * @var \DateTimeInterface|null
     */
    private $updated;
    /**
     * @var int
     */
    private $reviewsCount;
    /**
     * @var Review[]
     */
    private $reviews;

    /**
     * AppDetail constructor.
     *
     * @param AppBuilder $builder
     * @throws \InvalidArgumentException
     */
    public function __construct(AppBuilder $builder)
    {
        parent::__construct($builder);

        $this->description = $builder->getDescription();
        $this->translatedDescription = $builder->getTranslatedDescription();
        $this->translatedFromLanguage = $builder->getTranslatedFromLanguage();
        $this->headerImage = $builder->getHeaderImage();
        $this->screenshots = $builder->getScreenshots();
        $this->category = $builder->getCategory();
        $this->categoryFamily = $builder->getCategoryFamily();
        $this->privacyPoliceUrl = $builder->getPrivacyPoliceUrl();
        $this->video = $builder->getVideo();
        $this->recentChanges = $builder->getRecentChanges();
        $this->editorsChoice = $builder->isEditorsChoice();
        $this->installs = $builder->getInstalls();
        $this->numberVoters = $builder->getNumberVoters();
        $this->histogramRating = $builder->getHistogramRating() ??
            new HistogramRating(0, 0, 0, 0, 0);
        $this->price = $builder->getPrice();
        $this->currency = $builder->getCurrency() ?? 'USD';
        $this->offersIAPCost = $builder->getOffersIAPCost();
        $this->adSupported = $builder->isAdSupported();
        $this->appSize = $builder->getAppSize();
        $this->appVersion = $builder->getAppVersion();
        $this->androidVersion = $builder->getAndroidVersion();
        $this->minAndroidVersion = $builder->getMinAndroidVersion();
        $this->contentRating = $builder->getContentRating();
        $this->released = $builder->getReleased();
        $this->updated = $builder->getUpdated();
        $this->reviewsCount = $builder->getReviewsCount();
        $this->reviews = $builder->getReviews();

        if (empty($this->description)) {
            throw new \InvalidArgumentException('$description cannot be null or empty. Solution: $appBuilder->setDescription(...);');
        }
        if (empty($this->screenshots)) {
            throw new \InvalidArgumentException('$screenshots must contain at least one screenshot. Solution: $appBuilder->setScreenshots(...); or $appBuilder->addScreenshot(...);');
        }
        if ($this->category === null) {
            throw new \InvalidArgumentException('$category cannot be null. Solution: $appBuilder->setCategory(...);');
        }
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getTranslatedDescription(): ?string
    {
        return $this->translatedDescription;
    }

    /**
     * @return string|null
     */
    public function getTranslatedFromLanguage(): ?string
    {
        return $this->translatedFromLanguage;
    }

    /**
     * @return GoogleImage|null
     */
    public function getHeaderImage(): ?GoogleImage
    {
        return $this->headerImage;
    }

    /**
     * @return GoogleImage[]
     */
    public function getScreenshots(): array
    {
        return $this->screenshots;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @return string|null
     */
    public function getPrivacyPoliceUrl(): ?string
    {
        return $this->privacyPoliceUrl;
    }

    /**
     * @return Category|null
     */
    public function getCategoryFamily(): ?Category
    {
        return $this->categoryFamily;
    }

    /**
     * @return Video|null
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @return string|null
     */
    public function getRecentChanges(): ?string
    {
        return $this->recentChanges;
    }

    /**
     * @return bool
     */
    public function isEditorsChoice(): bool
    {
        return $this->editorsChoice;
    }

    /**
     * @return int
     */
    public function getInstalls(): int
    {
        return $this->installs;
    }

    /**
     * @return int
     */
    public function getNumberVoters(): int
    {
        return $this->numberVoters;
    }

    /**
     * @return HistogramRating
     */
    public function getHistogramRating(): HistogramRating
    {
        return $this->histogramRating;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return bool
     */
    public function isOffersIAP(): bool
    {
        return $this->offersIAPCost !== null;
    }

    /**
     * @return string|null
     */
    public function getOffersIAPCost(): ?string
    {
        return $this->offersIAPCost;
    }

    /**
     * @return bool
     */
    public function isAdSupported(): bool
    {
        return $this->adSupported;
    }

    /**
     * @return string|null
     */
    public function getAppSize(): ?string
    {
        return $this->appSize;
    }

    /**
     * @return string|null
     */
    public function getAppVersion(): ?string
    {
        return $this->appVersion;
    }

    /**
     * @return string|null
     */
    public function getAndroidVersion(): ?string
    {
        return $this->androidVersion;
    }

    /**
     * @return string|null
     */
    public function getMinAndroidVersion(): ?string
    {
        return $this->minAndroidVersion;
    }

    /**
     * @return string|null
     */
    public function getContentRating(): ?string
    {
        return $this->contentRating;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getReleased(): ?\DateTimeInterface
    {
        return $this->released;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * @return int
     */
    public function getReviewsCount(): int
    {
        return $this->reviewsCount;
    }

    /**
     * @return Review[]
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /**
     * @param AppDetail $o
     * @return bool
     */
    public function equals(AppDetail $o): bool
    {
        if ($o->getId() !== $this->getId()) {
            return false;
        }
        if ($o->getName() !== $this->getName()) {
            return false;
        }
        if ($o->description !== $this->description) {
            return false;
        }
        if ($o->recentChanges !== $this->recentChanges) {
            return false;
        }
        if ($o->getIcon()->getUrl() !== $this->getIcon()->getUrl()) {
            return false;
        }

        $diff = array_udiff($o->screenshots, $this->screenshots, static function (GoogleImage $a, GoogleImage $b) {
            return strcmp($a->getUrl(), $b->getUrl());
        });
        return empty($diff);
    }
}
