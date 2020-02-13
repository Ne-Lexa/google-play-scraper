<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Scraper\Extractor\ReviewsExtractor;
use Nelexa\HttpClient\ResponseHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class ReviewsScraper implements ResponseHandlerInterface
{
    /** @var AppId */
    private $requestApp;

    /**
     * ReviewsScraper constructor.
     *
     * @param AppId $requestApp
     */
    public function __construct(AppId $requestApp)
    {
        $this->requestApp = $requestApp;
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return array
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $contents = substr($response->getBody()->getContents(), 5);
        $json = \GuzzleHttp\json_decode($contents, true);

        if (!isset($json[0][2])) {
            return [[], null];
        }
        $json = \GuzzleHttp\json_decode($json[0][2], true);

        if (empty($json[0])) {
            return [[], null];
        }
        $reviews = ReviewsExtractor::extractReviews($this->requestApp, $json[0]);
        $nextToken = $json[1][1] ?? null;

        return [$reviews, $nextToken];
    }
}
