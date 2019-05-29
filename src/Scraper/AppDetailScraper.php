<?php
/** @noinspection MultiAssignmentUsageInspection */
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\AppDetail;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\HistogramRating;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Model\Video;
use Nelexa\GPlay\Request\RequestApp;
use Nelexa\GPlay\Scraper\Extractor\ReviewsExtractor;
use Nelexa\GPlay\Util\DateStringFormatter;
use Nelexa\GPlay\Util\LocaleHelper;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

class AppDetailScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return AppDetail
     * @throws GooglePlayException
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response): AppDetail
    {
        $query = parse_query($request->getUri()->getQuery());
        $appId = $query[GPlayApps::REQ_PARAM_ID];
        $locale = $query[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;
        $country = $query[GPlayApps::REQ_PARAM_COUNTRY] ?? GPlayApps::DEFAULT_COUNTRY;
        $requestApp = new RequestApp($appId, $locale, $country);

        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $scriptDataInfo = null;
        $scriptDataRating = null;
        $scriptDataPrice = null;
        $scriptDataVersion = null;
        $scriptDataReviews = [];

        foreach ($scriptData as $key => $scriptValue) {
            if (isset($scriptValue[0][12][5][5][4][2])) { // ds:5
                $scriptDataInfo = $scriptValue;
            } elseif (isset($scriptValue[0][2][0][0][0][1][0][0])) { // ds:3
                $scriptDataPrice = $scriptValue;
            } elseif (isset($scriptValue[0][0][0])
                && is_string($scriptValue[0][0][0])
                && strpos($scriptValue[0][0][0], 'gp:') === 0) { // ds:15
                $scriptDataReviews = $scriptValue;
            } elseif (isset($scriptValue[0][6][3][1])) { // ds:7
                $scriptDataRating = $scriptValue;
            } elseif (isset($scriptValue[0])
                && is_string($scriptValue[0])
                && count($scriptValue) === 3) { // ds:8
                $scriptDataVersion = $scriptValue;
            }
        }

        if (
            $scriptDataInfo === null ||
            $scriptDataRating === null ||
            $scriptDataPrice === null ||
            $scriptDataVersion === null
        ) {
            throw (new GooglePlayException('Unable to get data for this application.'))->setUrl($request->getUri()->__toString());
        }

        $name = $scriptDataInfo[0][0][0];
        $descriptionHTML = $scriptDataInfo[0][10][0][1];
        $description = ScraperUtil::html2text($descriptionHTML);

        $developer = $this->extractDeveloper($scriptDataInfo);
        $category = $this->extractCategory($scriptDataInfo[0][12][13][0]);

        $summary = empty($scriptDataInfo[0][10][1][1]) ?
            null :
            ScraperUtil::html2text($scriptDataInfo[0][10][1][1]);

        $installs = $scriptDataInfo[0][12][9][2] ?? 0;
        $score = (float)($scriptDataRating[0][6][0][1] ?? 0);
        $numberVoters = (int)($scriptDataRating[0][6][2][1] ?? 0);
        $reviewsCount = (int)($scriptDataRating[0][6][3][1] ?? 0);
        $histogram = $scriptDataRating[0][6][1] ?? null;

        $histogramRating = new HistogramRating(
            $histogram[5][1] ?? 0,
            $histogram[4][1] ?? 0,
            $histogram[3][1] ?? 0,
            $histogram[2][1] ?? 0,
            $histogram[1][1] ?? 0
        );

        $price = isset($scriptDataPrice[0][2][0][0][0][1][0][0]) ?
            (float)($scriptDataPrice[0][2][0][0][0][1][0][0] / 1000000) :
            0;
        $currency = $scriptDataPrice[0][2][0][0][0][1][0][1];
        $priceText = $scriptDataPrice[0][2][0][0][0][1][0][2] ?: 'Free';
        $offersIAPCost = $scriptDataInfo[0][12][12][0] ?? null;
        $adSupported = (bool)$scriptDataInfo[0][12][14][0];

        [$size, $appVersion, $androidVersion] = $scriptDataVersion;
        if (LocaleHelper::isDependOnDevice($locale, $size)) {
            $size = null;
        }
        if (LocaleHelper::isDependOnDevice($locale, $appVersion)) {
            $appVersion = null;
        }
        if (LocaleHelper::isDependOnDevice($locale, $androidVersion)) {
            $androidVersion = null;
            $minAndroidVersion = null;
        } else {
            $minAndroidVersion = preg_replace('~.*?(\d+(\.\d+)*).*~', '$1', $androidVersion);
        }

        $editorsChoice = !empty($scriptDataInfo[0][12][15][1][1]);
        $privacyPoliceUrl = $scriptDataInfo[0][12][7][2];

        $categoryFamily = $this->extractCategory($scriptDataInfo[0][12][13][1] ?? []);

        $icon = empty($scriptDataInfo[0][12][1][3][2]) ?
            null :
            new GoogleImage($scriptDataInfo[0][12][1][3][2]);

        $headerImage = empty($scriptDataInfo[0][12][2][3][2]) ?
            null :
            new GoogleImage($scriptDataInfo[0][12][2][3][2]);

        $screenshots = $this->extractScreenshots($scriptDataInfo);
        $video = $this->extractVideo($scriptDataInfo);

        $contentRating = $scriptDataInfo[0][12][4][0];
        $released = $this->extractReleaseDate($scriptDataInfo, $locale);
        $updated = $this->extractUpdatedDate($scriptDataInfo);

        $recentChanges = empty($scriptDataInfo[0][12][6][1]) ?
            null :
            ScraperUtil::html2text($scriptDataInfo[0][12][6][1]);

        $translatedFromLanguage = null;
        $translatedDescription = null;
        if (isset($scriptDataInfo[0][19][1])) {
            $translatedFromLanguage = LocaleHelper::findPreferredLanguage(
                $locale,
                $scriptDataInfo[0][19][1]
            );
            $translatedDescription = ScraperUtil::html2text($scriptDataInfo[0][19][0][0][1]);
        }

        $reviews = $this->extractReviews($requestApp, $scriptDataReviews);

        return new AppDetail(
            AppDetail::newBuilder()
                ->setId($appId)
                ->setUrl($requestApp->getUrl())
                ->setLocale($locale)
                ->setName($name)
                ->setDescription($description)
                ->setTranslated($translatedDescription, $translatedFromLanguage)
                ->setSummary($summary)
                ->setIcon($icon)
                ->setHeaderImage($headerImage)
                ->setScreenshots($screenshots)
                ->setDeveloper($developer)
                ->setCategory($category)
                ->setCategoryFamily($categoryFamily)
                ->setVideo($video)
                ->setRecentChanges($recentChanges)
                ->setEditorsChoice($editorsChoice)
                ->setPrivacyPoliceUrl($privacyPoliceUrl)
                ->setInstalls($installs)
                ->setScore($score)
                ->setRecentChanges($recentChanges)
                ->setEditorsChoice($editorsChoice)
                ->setPrivacyPoliceUrl($privacyPoliceUrl)
                ->setInstalls($installs)
                ->setScore($score)
                ->setNumberVoters($numberVoters)
                ->setHistogramRating($histogramRating)
                ->setPrice($price)
                ->setCurrency($currency)
                ->setPriceText($priceText)
                ->setOffersIAPCost($offersIAPCost)
                ->setAdSupported($adSupported)
                ->setAppSize($size)
                ->setAppVersion($appVersion)
                ->setAndroidVersion($androidVersion)
                ->setMinAndroidVersion($minAndroidVersion)
                ->setContentRating($contentRating)
                ->setReleased($released)
                ->setUpdated($updated)
                ->setReviewsCount($reviewsCount)
                ->setReviews($reviews)
        );
    }

    /**
     * @param array $scriptDataInfo
     * @return Developer
     */
    private function extractDeveloper(array $scriptDataInfo): Developer
    {
        $developerPage = GPlayApps::GOOGLE_PLAY_URL . $scriptDataInfo[0][12][5][5][4][2];
        $developerId = parse_query(parse_url($developerPage, PHP_URL_QUERY))[GPlayApps::REQ_PARAM_ID];
        $developerName = $scriptDataInfo[0][12][5][1];
        $developerEmail = $scriptDataInfo[0][12][5][2][0];
        $developerWebsite = $scriptDataInfo[0][12][5][3][5][2];
        $developerAddress = $scriptDataInfo[0][12][5][4][0];
//        $developerInternalID = (int)$scriptDataInfo[0][12][5][0][0];

        return new Developer(
            Developer::newBuilder()
                ->setId($developerId)
                ->setUrl($developerPage)
                ->setName($developerName)
                ->setEmail($developerEmail)
                ->setAddress($developerAddress)
                ->setWebsite($developerWebsite)
        );
    }

    /**
     * @param array $data
     * @return Category|null
     */
    private function extractCategory(array $data): ?Category
    {
        if (isset($data[0]) && $data[0] !== null && $data[2] !== null) {
            $genreId = (string)$data[2];
            $genreName = (string)$data[0];
            return new Category($genreId, $genreName);
        }
        return null;
    }

    /**
     * @param array $scriptDataInfo
     * @return GoogleImage[]
     */
    private function extractScreenshots(array $scriptDataInfo): array
    {
        return !empty($scriptDataInfo[0][12][0]) ? array_map(static function (array $v) {
            return new GoogleImage($v[3][2]);
        }, $scriptDataInfo[0][12][0]) : [];
    }

    /**
     * @param array $scriptDataInfo
     * @return Video|null
     */
    private function extractVideo(array $scriptDataInfo): ?Video
    {
        if (
            isset($scriptDataInfo[0][12][3][0][3][2]) &&
            $scriptDataInfo[0][12][3][0][3][2] !== null &&
            $scriptDataInfo[0][12][3][1][3][2] !== null
        ) {
            $videoThumb = (string)$scriptDataInfo[0][12][3][1][3][2];
            $videoUrl = (string)$scriptDataInfo[0][12][3][0][3][2];

            return new Video($videoThumb, $videoUrl);
        }
        return null;
    }

    /**
     * @param array $scriptDataInfo
     * @param string $locale
     * @return \DateTimeInterface|null
     */
    private function extractReleaseDate(array $scriptDataInfo, string $locale): ?\DateTimeInterface
    {
        if (isset($scriptDataInfo[0][12][36])) {
            return DateStringFormatter::formatted($locale, $scriptDataInfo[0][12][36]);
        }
        return null;
    }

    /**
     * @param array $scriptDataInfo
     * @return \DateTimeInterface|null
     */
    private function extractUpdatedDate(array $scriptDataInfo): ?\DateTimeInterface
    {
        if (isset($scriptDataInfo[0][12][8][0])) {
            return DateStringFormatter::unixTimeToDateTime($scriptDataInfo[0][12][8][0]);
        }
        return null;
    }

    /**
     * @param RequestApp $requestApp
     * @param array $scriptDataReviews
     * @param int $limit
     * @return Review[]
     */
    private function extractReviews(RequestApp $requestApp, array $scriptDataReviews, int $limit = 4): array
    {
        if (empty($scriptDataReviews[0])) {
            return [];
        }

        return ReviewsExtractor::extractReviews(
            $requestApp,
            array_slice($scriptDataReviews[0], 0, $limit)
        );
    }
}
