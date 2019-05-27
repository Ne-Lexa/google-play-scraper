<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use function GuzzleHttp\Psr7\parse_query;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\ReplyReview;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Util\LocaleHelper;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AppReviewScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return Review[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response): array
    {
        $contents = substr($response->getBody()->getContents(), 6);
        $json = \GuzzleHttp\json_decode($contents, true);
        $html = $json[0][2];

        $doc = new \DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);
        if (!$doc->loadHTML('<?xml encoding="utf-8" ?>' . $html)) {
            throw new \RuntimeException('error load html');
        }
        libxml_use_internal_errors($internalErrors);

        $locale = parse_query($request->getUri()->getQuery())[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;

        $reviews = [];

        $xpath = new \DOMXPath($doc);
        $reviewNodes = $xpath->query('//div[@class="single-review"]');
        /**
         * @var \DOMElement $reviewNode
         */
        foreach ($reviewNodes as $reviewNode) {
            // review id
            {
                $reviewIdNode = $xpath->query('.//div[@data-reviewid]', $reviewNode)->item(0);
                if ($reviewIdNode === null) {
                    continue;
                }
                $reviewId = $reviewIdNode->attributes->getNamedItem('data-reviewid')->textContent;

                // url
                {
                    $reviewUrlNode = $xpath->query('.//a[@class="reviews-permalink"]/@href', $reviewIdNode);
                    if ($reviewUrlNode === null) {
                        continue;
                    }
                    $reviewUrl = GPlayApps::GOOGLE_PLAY_URL . $reviewUrlNode->item(0)->textContent;
                }
                // user name
                {
                    $userNameNode = $xpath->query('.//span[@class="author-name"]', $reviewIdNode)->item(0);
                    if ($userNameNode === null) {
                        continue;
                    }
                    $userName = trim($userNameNode->textContent);
                }
                // review date
                {
                    $reviewDateNode = $xpath->query('.//span[@class="review-date"]', $reviewIdNode)->item(0);
                    if ($reviewDateNode === null) {
                        continue;
                    }
                    $reviewDate = trim($reviewDateNode->textContent);
                    $reviewDateTime = LocaleHelper::strToDateTime($locale, $reviewDate);
                }
            }
            // avatar
            {
                $avatar = null;
                $avatarAttr = $xpath->query('.//span[@class="responsive-img-hdpi"]/span/@style', $reviewNode)->item(0);
                if ($avatarAttr !== null) {
                    $style = $avatarAttr->textContent;
                    if (preg_match('~url\s*\((.*?)\)~', $style, $match)) {
                        $avatarImage = $match[1];
                        $avatarImage = str_replace(['"', "'"], '', $avatarImage);
                        $avatar = new GoogleImage($avatarImage);
                    }
                }
            }
            // rating
            {
                $score = 0;
                $ratingStyleAttr = $xpath->query('.//div[@class="current-rating" and @style]/@style', $reviewNode)->item(0);
                if ($ratingStyleAttr !== null) {
                    $ratingStyle = $ratingStyleAttr->textContent;
                    if (preg_match('/([\d]+)%/', $ratingStyle, $match)) {
                        $score = (int)($match[1] * 0.05); // percent * 5 star
                    }
                }
            }
            // text
            {
                $reviewTextNode = $xpath->query(".//div[@class and contains(concat(' ', normalize-space(@class), ' '), ' review-body ')]", $reviewNode)->item(0);
                if ($reviewTextNode === null) {
                    continue;
                }
                $nodeReviewLinkNode = $xpath->query(".//div[@class='review-link']", $reviewTextNode);
                if ($nodeReviewLinkNode->length > 0) {
                    $reviewTextNode->removeChild($nodeReviewLinkNode->item(0));
                }
                $reviewText = trim($reviewTextNode->textContent);
            }
            // reply
            {
                $reply = null;
                if ($reviewNode->nextSibling !== null && $reviewNode->nextSibling->nextSibling->getAttribute('class') === 'developer-reply') {
                    $replyDateTime = null;
                    $replyNode = $reviewNode->nextSibling->nextSibling;
                    // reply date
                    {
                        $replyDateNode = $xpath->query('.//span[@class="review-date"]', $replyNode)->item(0);
                        if ($replyDateNode !== null) {
                            $replyDate = trim($replyDateNode->textContent);
                            $replyDateTime = LocaleHelper::strToDateTime($locale, $replyDate);
                        }
                    }
                    // reply text
                    {
                        $replyText = null;
                        $replyTextNode = $replyNode->childNodes->item(2);
                        if ($replyTextNode !== null) {
                            $replyText = trim($replyTextNode->textContent);
                        }
                    }
                    if ($replyDateTime !== null && $replyText !== null) {
                        $reply = new ReplyReview(
                            $replyDateTime,
                            $replyText
                        );
                    }
                }
            }

            $reviews[] = new Review(
                $reviewId,
                $reviewUrl,
                $userName,
                $reviewText,
                $avatar,
                $reviewDateTime,
                $score,
                0,
                $reply
            );
        }
        return $reviews;
    }
}
