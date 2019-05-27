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
use Nelexa\GPlay\Model\ReplyReview;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Model\Video;
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
        $url = $request->getUri()->__toString();
        $urlComponents = parse_url($url);
        $query = parse_query($urlComponents['query']);
        $appId = $query[GPlayApps::REQ_PARAM_APP_ID];
        $url = $urlComponents['scheme'] . '://'
            . $urlComponents['host']
            . $urlComponents['path']
            . '?' . http_build_query([GPlayApps::REQ_PARAM_APP_ID => $appId]);
        $locale = $query[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;

        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $scriptDataInfo = null;
        $scriptDataRating = null;
        $scriptDataPrice = null;
        $scriptDataVersion = null;
        $scriptDataReviews = [];

        foreach ($scriptData as $key => $scriptValue) {
            if (isset($scriptValue[0][12][5][5][4][2])) {
                $scriptDataInfo = $scriptValue;
            } elseif (isset($scriptValue[0][2][0][0][0][1][0][0])) {
                $scriptDataPrice = $scriptValue;
            } elseif (isset($scriptValue[0][0][0])
                && is_string($scriptValue[0][0][0])
                && strpos($scriptValue[0][0][0], 'gp:') === 0) {
                $scriptDataReviews = $scriptValue;
            } elseif (isset($scriptValue[0][6][3][1])) {
                $scriptDataRating = $scriptValue;
            } elseif (isset($scriptValue[0])
                && is_string($scriptValue[0])
                && count($scriptValue) === 3) {
                $scriptDataVersion = $scriptValue;
            }
        }

        if (
            $scriptDataInfo === null ||
            $scriptDataRating === null ||
            $scriptDataPrice === null ||
            $scriptDataVersion === null
        ) {
            throw (new GooglePlayException('Unable to get data for this application.'))->setUrl($url);
        }

        $name = $scriptDataInfo[0][0][0];
        $descriptionHTML = $scriptDataInfo[0][10][0][1];
        $description = ScraperUtil::html2text($descriptionHTML);

        $developerPage = GPlayApps::GOOGLE_PLAY_URL . $scriptDataInfo[0][12][5][5][4][2];
        $developerId = parse_query(parse_url($developerPage, PHP_URL_QUERY))['id'];
        $developerName = $scriptDataInfo[0][12][5][1];
        $developerEmail = $scriptDataInfo[0][12][5][2][0];
        $developerWebsite = $scriptDataInfo[0][12][5][3][5][2];
        $developerAddress = $scriptDataInfo[0][12][5][4][0];
//        $developerInternalID = (int)$scriptDataInfo[0][12][5][0][0];

        $genreId = $scriptDataInfo[0][12][13][0][2];
        $genreName = $scriptDataInfo[0][12][13][0][0];

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
            $minAndroidVersion = preg_replace('~.*?(\d+(\.\d+)?).*~', '$1', $androidVersion);
        }

        $editorsChoice = !empty($scriptDataInfo[0][12][15][1][1]);
        $privacyPoliceUrl = $scriptDataInfo[0][12][7][2];

        $familyGenreId = null;
        $familyGenreName = null;
        if (
            isset($scriptDataInfo[0][12][13][1][0]) &&
            $scriptDataInfo[0][12][13][1][0] !== null &&
            $scriptDataInfo[0][12][13][1][2] !== null
        ) {
            $familyGenreId = (string)$scriptDataInfo[0][12][13][1][2];
            $familyGenreName = (string)$scriptDataInfo[0][12][13][1][0];
        }

        $icon = empty($scriptDataInfo[0][12][1][3][2]) ?
            null :
            new GoogleImage($scriptDataInfo[0][12][1][3][2]);

        $headerImage = empty($scriptDataInfo[0][12][2][3][2]) ?
            null :
            new GoogleImage($scriptDataInfo[0][12][2][3][2]);

        $screenshots = !empty($scriptDataInfo[0][12][0]) ? array_map(static function (array $v) {
            return new GoogleImage($v[3][2]);
        }, $scriptDataInfo[0][12][0]) : [];

        $videoThumb = null;
        $videoUrl = null;
        if (
            isset($scriptDataInfo[0][12][3][0][3][2]) &&
            $scriptDataInfo[0][12][3][0][3][2] !== null &&
            $scriptDataInfo[0][12][3][1][3][2] !== null
        ) {
            $videoThumb = (string)$scriptDataInfo[0][12][3][1][3][2];
            $videoUrl = (string)$scriptDataInfo[0][12][3][0][3][2];
        }

        $contentRating = $scriptDataInfo[0][12][4][0];
        $released = null;
        if (isset($scriptDataInfo[0][12][36]) && $scriptDataInfo[0][12][36] !== null) {
            $released = LocaleHelper::strToDateTime($locale, $scriptDataInfo[0][12][36]);
        }
        try {
            $updated = !empty($scriptDataInfo[0][12][8][0]) ?
                new \DateTimeImmutable('@' . $scriptDataInfo[0][12][8][0])
                : null;
        } catch (\Exception $e) {
            $updated = null;
        }

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

        $reviews = $this->extractReviews($url, $scriptDataReviews);

        $developerBuilder = Developer::newBuilder()
            ->setId($developerId)
            ->setUrl($developerPage)
            ->setName($developerName)
            ->setEmail($developerEmail)
            ->setAddress($developerAddress)
            ->setWebsite($developerWebsite);

        $appBuilder = AppDetail::newBuilder()
            ->setId($appId)
            ->setLocale($locale)
            ->setName($name)
            ->setDescription($description)
            ->setTranslated($translatedDescription, $translatedFromLanguage)
            ->setSummary($summary)
            ->setIcon($icon)
            ->setHeaderImage($headerImage)
            ->setScreenshots($screenshots)
            ->setDeveloper(new Developer($developerBuilder))
            ->setCategory(new Category(
                $genreId,
                $genreName
            ))
            ->setCategoryFamily(
                $familyGenreId !== null && $familyGenreName !== null ?
                    new Category($familyGenreId, $familyGenreName) :
                    null
            )
            ->setVideo(
                $videoThumb !== null && $videoUrl !== null ?
                    new Video($videoThumb, $videoUrl) :
                    null
            )
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
            ->setReviews($reviews);
        return new AppDetail($appBuilder);
    }

    /**
     * @param string $appUrl
     * @param array $scriptDataReviews
     * @param int $limit
     * @return Review[]
     */
    private function extractReviews(string $appUrl, array $scriptDataReviews, int $limit = 4): array
    {
        if (empty($scriptDataReviews)) {
            return [];
        }
        $reviews = [];
        $count = min($limit, count($scriptDataReviews[0]));
        for ($i = 0; $i < $count; $i++) {
            $reviewData = $scriptDataReviews[0][$i];
            $reviewId = $reviewData[0];
            $reviewUrl = $appUrl . '&reviewId=' . urlencode($reviewId);
            $userName = $reviewData[1][0];
            $avatar = new GoogleImage($reviewData[1][1][3][2]);
            $date = null;
            if (isset($reviewData[5][0])) {
                try {
                    $date = new \DateTimeImmutable('@' . $reviewData[5][0]);
                } catch (\Exception $e) {
                    $date = null;
                }
            }
            $score = $reviewData[2] ?? 0;
            $text = (string)($reviewData[4] ?? '');
            $likeCount = $reviewData[6];

            $reply = null;
            if (isset($reviewData[7][1])) {
                $replyText = $reviewData[7][1];
                try {
                    $replyDate = new \DateTimeImmutable('@' . $reviewData[7][2][0]);
                    $reply = new ReplyReview(
                        $replyDate,
                        $replyText
                    );
                } catch (\Exception $e) {
                    $replyDate = null;
                }
            }

            $reviews[] = new Review(
                $reviewId,
                $reviewUrl,
                $userName,
                $text,
                $avatar,
                $date,
                $score,
                $likeCount,
                $reply
            );
        }
        return $reviews;
    }
}
