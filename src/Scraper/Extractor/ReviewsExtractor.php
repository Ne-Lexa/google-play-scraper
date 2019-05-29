<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper\Extractor;

use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\ReplyReview;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Request\RequestApp;
use Nelexa\GPlay\Util\DateStringFormatter;

class ReviewsExtractor
{
    /**
     * @param RequestApp $requestApp
     * @param array $data
     * @return array
     */
    public static function extractReviews(RequestApp $requestApp, array $data): array
    {
        $reviews = [];
        foreach ($data as $reviewData) {
            $reviewId = $reviewData[0];
            $reviewUrl = $requestApp->getUrl() . '&reviewId=' . urlencode($reviewId);
            $userName = $reviewData[1][0];
            $avatar = new GoogleImage($reviewData[1][1][3][2]);
            $date = null;
            if (isset($reviewData[5][0])) {
                $date = DateStringFormatter::unixTimeToDateTime($reviewData[5][0]);
            }
            $score = $reviewData[2] ?? 0;
            $text = (string)($reviewData[4] ?? '');
            $likeCount = $reviewData[6];

            $reply = self::extractReplyReview($reviewData);

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

    /**
     * @param array $reviewData
     * @return ReplyReview|null
     */
    private static function extractReplyReview(array $reviewData): ?ReplyReview
    {
        if (isset($reviewData[7][1])) {
            $replyText = $reviewData[7][1];
            $replyDate = DateStringFormatter::unixTimeToDateTime($reviewData[7][2][0]);
            if ($replyText && $reviewData) {
                return new ReplyReview(
                    $replyDate,
                    $replyText
                );
            }
        }
        return null;
    }
}
