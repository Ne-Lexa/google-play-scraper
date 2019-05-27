<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model\Builder;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\HistogramRating;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Model\Video;

class AppBuilder
{
    /**
     * @var string|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $url;
    /**
     * @var string|null
     */
    private $name;
    /**
     * @var string|null
     */
    private $summary;
    /**
     * @var Developer|null
     */
    private $developer;
    /**
     * @var GoogleImage|null
     */
    private $icon;
    /**
     * @var float
     */
    private $score = 0.0;
    /**
     * @var string|null
     */
    private $priceText;
    /**
     * @var string|null
     */
    private $locale;
    /**
     * @var string|null
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
    private $screenshots = [];
    /**
     * @var Category|null
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
    private $editorsChoice = false;
    /**
     * @var int
     */
    private $installs = 0;
    /**
     * @var int
     */
    private $numberVoters = 0;
    /**
     * @var HistogramRating|null
     */
    private $histogramRating;
    /**
     * @var float
     */
    private $price = 0;
    /**
     * @var string|null
     */
    private $currency;
    /**
     * @var string|null
     */
    private $offersIAPCost;
    /**
     * @var bool
     */
    private $adSupported = false;
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
    private $reviewsCount = 0;
    /**
     * @var Review[]
     */
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
     * @return AppBuilder
     */
    public function setId(string $id): AppBuilder
    {
        $this->id = $id;
        $this->url = GPlayApps::GOOGLE_PLAY_APPS_URL . '/details?id=' . $id;
        return $this;
    }

    /**
     * @param string|null $url
     * @return AppBuilder
     */
    public function setUrl(?string $url): AppBuilder
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
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
     * @return AppBuilder
     */
    public function setName(?string $name): AppBuilder
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
     * @return AppBuilder
     */
    public function setSummary(?string $summary): AppBuilder
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
     * @return AppBuilder
     */
    public function setDeveloper(?Developer $developer): AppBuilder
    {
        $this->developer = $developer;
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
     * @return AppBuilder
     */
    public function setIcon(?GoogleImage $icon): AppBuilder
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
     * @return AppBuilder
     */
    public function setScore(float $score): AppBuilder
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
     * @return AppBuilder
     */
    public function setPriceText(?string $priceText): AppBuilder
    {
        $this->priceText = $priceText;
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
     * @return AppBuilder
     */
    public function setLocale(?string $locale): AppBuilder
    {
        $this->locale = $locale;
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
     * @return AppBuilder
     */
    public function setDescription(?string $description): AppBuilder
    {
        $this->description = $description;
        return $this;
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
     * @param string|null $translatedDescription
     * @param string|null $translatedFromLanguage
     * @return AppBuilder
     */
    public function setTranslated(
        ?string $translatedDescription,
        ?string $translatedFromLanguage
    ): AppBuilder {
        if ($translatedFromLanguage === null || $translatedDescription === null) {
            $this->translatedDescription = null;
            $this->translatedFromLanguage = null;
        } else {
            $this->translatedDescription = $translatedDescription;
            $this->translatedFromLanguage = $translatedFromLanguage;
        }
        return $this;
    }

    /**
     * @return GoogleImage|null
     */
    public function getHeaderImage(): ?GoogleImage
    {
        return $this->headerImage;
    }

    /**
     * @param GoogleImage|null $headerImage
     * @return AppBuilder
     */
    public function setHeaderImage(?GoogleImage $headerImage): AppBuilder
    {
        $this->headerImage = $headerImage;
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
     * @return AppBuilder
     */
    public function setScreenshots(array $screenshots): AppBuilder
    {
        $this->screenshots = [];
        foreach ($screenshots as $screenshot) {
            $this->addScreenshot($screenshot);
        }
        return $this;
    }

    /**
     * @param GoogleImage $image
     * @return AppBuilder
     */
    public function addScreenshot(GoogleImage $image): AppBuilder
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
     * @return AppBuilder
     */
    public function setCategory(?Category $category): AppBuilder
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
     * @return AppBuilder
     */
    public function setPrivacyPoliceUrl(?string $privacyPoliceUrl): AppBuilder
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
     * @return AppBuilder
     */
    public function setCategoryFamily(?Category $categoryFamily): AppBuilder
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
     * @return AppBuilder
     */
    public function setVideo(?Video $video): AppBuilder
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
     * @return AppBuilder
     */
    public function setRecentChanges(?string $recentChanges): AppBuilder
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
     * @return AppBuilder
     */
    public function setEditorsChoice(bool $editorsChoice): AppBuilder
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
     * @return AppBuilder
     */
    public function setInstalls(int $installs): AppBuilder
    {
        $this->installs = $installs;
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
     * @return AppBuilder
     */
    public function setNumberVoters(int $numberVoters): AppBuilder
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
     * @return AppBuilder
     */
    public function setHistogramRating(?HistogramRating $histogramRating): AppBuilder
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
     * @return AppBuilder
     */
    public function setPrice(float $price): AppBuilder
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
     * @return AppBuilder
     */
    public function setCurrency(?string $currency): AppBuilder
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
     * @return AppBuilder
     */
    public function setOffersIAPCost(?string $offersIAPCost): AppBuilder
    {
        $this->offersIAPCost = $offersIAPCost;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdSupported(): bool
    {
        return $this->adSupported;
    }

    /**
     * @param bool $adSupported
     * @return AppBuilder
     */
    public function setAdSupported(bool $adSupported): AppBuilder
    {
        $this->adSupported = $adSupported;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAppSize(): ?string
    {
        return $this->appSize;
    }

    /**
     * @param string|null $appSize
     * @return AppBuilder
     */
    public function setAppSize(?string $appSize): AppBuilder
    {
        $this->appSize = $appSize;
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
     * @return AppBuilder
     */
    public function setAppVersion(?string $appVersion): AppBuilder
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
     * @return AppBuilder
     */
    public function setAndroidVersion(?string $androidVersion): AppBuilder
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
     * @return AppBuilder
     */
    public function setMinAndroidVersion(?string $minAndroidVersion): AppBuilder
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
     * @return AppBuilder
     */
    public function setContentRating(?string $contentRating): AppBuilder
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
     * @return AppBuilder
     */
    public function setReleased(?\DateTimeInterface $released): AppBuilder
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
     * @return AppBuilder
     */
    public function setUpdated(?\DateTimeInterface $updated): AppBuilder
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return int
     */
    public function getReviewsCount(): int
    {
        return $this->reviewsCount;
    }

    /**
     * @param int $reviewsCount
     * @return AppBuilder
     */
    public function setReviewsCount(int $reviewsCount): AppBuilder
    {
        $this->reviewsCount = $reviewsCount;
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
     * @return AppBuilder
     */
    public function setReviews(array $reviews): AppBuilder
    {
        $this->reviews = [];
        foreach ($reviews as $review) {
            $this->addReview($review);
        }
        return $this;
    }

    /**
     * @param Review $review
     * @return AppBuilder
     */
    public function addReview(Review $review): AppBuilder
    {
        $this->reviews[] = $review;
        return $this;
    }
}
