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

namespace Nelexa\GPlay\Scraper;

use GuzzleHttp\Psr7\Query;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\HttpClient\ParseHandlerInterface;
use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Model\AppInfo;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\HistogramRating;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Model\Video;
use Nelexa\GPlay\Scraper\Extractor\ReviewsExtractor;
use Nelexa\GPlay\Util\DateStringFormatter;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class AppInfoScraper implements ParseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $options
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     *
     * @return AppInfo
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): AppInfo
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $appInfo = null;
        $editorsChoice = false;

        foreach ($scriptData as $data) {
            if (isset($data[1][2][72][0][1])) {
                $appInfo = $data[1][2];
            } elseif (isset($data[1][2][136][0][1][0])) {
                $editorsChoice = (bool) $data[1][2][136][0][1][0];
            }
        }

        if (!\is_array($appInfo)) {
            throw (new GooglePlayException('Unable to get data for this application.'))->setUrl(
                $request->getUri()->__toString()
            );
        }

        $query = Query::parse($request->getUri()->getQuery());
        $id = $query[GPlayApps::REQ_PARAM_ID];
        $locale = $query[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;
        $country = $query[GPlayApps::REQ_PARAM_COUNTRY] ?? GPlayApps::DEFAULT_COUNTRY;

        $name = $appInfo[0][0];
        $description = ScraperUtil::html2text($appInfo[72][0][1]);
        $developer = $this->extractDeveloper($appInfo);

        $category = $this->extractCategory($appInfo[79][0][0] ?? []);
        $summary = $this->extractSummary($appInfo);
        $installsText = $appInfo[13][0] ?? null;
        $installs = $appInfo[13][2] ?? 0;
        $score = (float) ($appInfo[51][0][1] ?? 0);
        $numberVoters = (int) ($appInfo[51][2][1] ?? 0);
        $numberReviews = (int) ($appInfo[51][3][1] ?? 0);
        $histogramRating = null;
        if (isset($appInfo[51][1])) {
            $histogramRating = $this->extractHistogramRating($appInfo[51][1]);
        }

        $scriptDataPrice = $appInfo[57][0][0][0][0][1] ?? null;
        $price = $scriptDataPrice !== null ? $this->extractPrice($scriptDataPrice) : 0.0;
        $currency = $scriptDataPrice[0][1] ?? 'USD';
        $priceText = $scriptDataPrice[0][2] ?? null;

        $offersIAPCost = $appInfo[19][0] ?? null;
        $containsAds = (bool) ($appInfo[48][0] ?? false);

        $androidVersion = $appInfo[140][1][1][0][0][1] ?? null;
        $appVersion = $appInfo[140][0][0][0] ?? null;

        if ($androidVersion !== null) {
            $minAndroidVersion = preg_replace('~.*?(\d+(\.\d+)*).*~', '$1', $androidVersion);
        } else {
            $minAndroidVersion = null;
        }

        $privacyPoliceUrl = $appInfo[99][0][5][2] ?? '';
        $categoryFamily = $this->extractCategory($appInfo[118][0][0][0] ?? []);
        $icon = $this->extractIcon($appInfo);
        $cover = $this->extractCover($appInfo);
        $screenshots = $this->extractScreenshots($appInfo);
        $video = $this->extractVideo($appInfo);
        $contentRating = $appInfo[111][1] ?? '';
        $released = $this->convertDate($appInfo[10][1][0] ?? null);
        $updated = $this->convertDate($appInfo[145][0][1][0] ?? null);
        $recentChanges = $this->extractRecentChanges($appInfo);

        $reviews = $this->extractReviews(new AppId($id, $locale, $country), $scriptData);

        return AppInfo::newBuilder()
            ->setId($id)
            ->setLocale($locale)
            ->setCountry($country)
            ->setName($name)
            ->setDescription($description)
            ->setSummary($summary)
            ->setIcon($icon)
            ->setCover($cover)
            ->setScreenshots($screenshots)
            ->setDeveloper($developer)
            ->setCategory($category)
            ->setCategoryFamily($categoryFamily)
            ->setVideo($video)
            ->setRecentChanges($recentChanges)
            ->setEditorsChoice($editorsChoice)
            ->setPrivacyPoliceUrl($privacyPoliceUrl)
            ->setInstalls($installs)
            ->setInstallsText($installsText)
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
            ->setContainsAds($containsAds)
            ->setAppVersion($appVersion)
            ->setAndroidVersion($androidVersion)
            ->setMinAndroidVersion($minAndroidVersion)
            ->setContentRating($contentRating)
            ->setReleased($released)
            ->setUpdated($updated)
            ->setNumberReviews($numberReviews)
            ->setReviews($reviews)
            ->buildDetailInfo()
        ;
    }

    /**
     * @param array $appInfo
     *
     * @return string|null
     */
    private function extractSummary(array $appInfo): ?string
    {
        return empty($appInfo[73][0][1])
            ? null
            : ScraperUtil::html2text(str_replace("\n", ' ', $appInfo[73][0][1]));
    }

    /**
     * @param array $appInfo
     *
     * @return Developer
     */
    private function extractDeveloper(array $appInfo): Developer
    {
        $developerPage = GPlayApps::GOOGLE_PLAY_URL . $appInfo[68][1][4][2];
        $developerId = Query::parse(parse_url($developerPage, \PHP_URL_QUERY))[GPlayApps::REQ_PARAM_ID];
        $developerName = $appInfo[68][0];
        $developerEmail = $appInfo[69][1][0] ?? null;
        $developerWebsite = $appInfo[69][0][5][2] ?? null;
        $developerAddress = $appInfo[69][2][0] ?? null;

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
     *
     * @return Category|null
     */
    private function extractCategory(array $data): ?Category
    {
        if (isset($data[1][4][2], $data[0], $data[2])) {
            $categorySlug = (string) $data[2];
            $categoryName = (string) $data[0];

            return new Category($categorySlug, $categoryName);
        }

        return null;
    }

    /**
     * @param array|null $data
     *
     * @return HistogramRating
     */
    private function extractHistogramRating(array $data): HistogramRating
    {
        return new HistogramRating(
            $data[1][1] ?? 0,
            $data[2][1] ?? 0,
            $data[3][1] ?? 0,
            $data[4][1] ?? 0,
            $data[5][1] ?? 0
        );
    }

    /**
     * @param array $scriptDataPrice
     *
     * @return float
     */
    protected function extractPrice(array $scriptDataPrice): ?float
    {
        return isset($scriptDataPrice[0][0])
            ? (float) ($scriptDataPrice[0][0] / 1000000)
            : 0.0;
    }

    /**
     * @param array $data
     *
     * @return GoogleImage|null
     */
    protected function extractIcon(array $data): ?GoogleImage
    {
        return empty($data[95][0][3][2])
            ? null
            : new GoogleImage($data[95][0][3][2]);
    }

    /**
     * @param array $data
     *
     * @return GoogleImage|null
     */
    protected function extractCover(array $data): ?GoogleImage
    {
        return empty($data[96][0][3][2])
            ? null
            : new GoogleImage($data[96][0][3][2]);
    }

    /**
     * @param array $data
     *
     * @return GoogleImage[]
     */
    private function extractScreenshots(array $data): array
    {
        return !empty($data[78][0][0][3][2]) ? array_map(
            static function (array $v) {
                return new GoogleImage($v[3][2]);
            },
            $data[78][0]
        ) : [];
    }

    /**
     * @param array $data
     *
     * @return Video|null
     */
    private function extractVideo(array $data): ?Video
    {
        if (isset($data[100][0][0][4], $data[100][0][1][3][3])) {
            $videoThumb = (string) $data[100][0][1][3][2];
            $youtubeId = (string) $data[100][0][4];
            $youtubeId = str_replace('yt:', '', strtok($youtubeId, '?'));
            $videoUrl = 'https://www.youtube.com/embed/' . $youtubeId . '?ps=play&vq=large&rel=0&autohide=1&showinfo=0';

            return new Video($videoThumb, $videoUrl);
        }

        return null;
    }

    /**
     * @param ?int $timestamp
     *
     * @return \DateTimeInterface|null
     */
    private function convertDate(?int $timestamp): ?\DateTimeInterface
    {
        if ($timestamp !== null) {
            return DateStringFormatter::unixTimeToDateTime($timestamp);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return string|null
     */
    protected function extractRecentChanges(array $data): ?string
    {
        return empty($data[144][1][1])
            ? null
            : ScraperUtil::html2text($data[144][1][1]);
    }

    /**
     * @param AppId $appId
     * @param array $data
     * @param array $scripData
     *
     * @return Review[]
     */
    private function extractReviews(AppId $appId, array $scripData): array
    {
        $data = null;
        foreach ($scripData as $value) {
            if (
                isset($value[0][0][0])
                && \is_string($value[0][0][0])
                && preg_match('~^[0-9a-f]{8}-[0-9a-f]{4}-~', $value[0][0][0])
            ) {
                $data = $value[0];
                break;
            }
        }

        if ($data === null) {
            return [];
        }

        return ReviewsExtractor::extractReviews($appId, $data);
    }
}
