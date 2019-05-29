<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Request\RequestApp;
use Nelexa\GPlay\Scraper\Extractor\ReviewsExtractor;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ReviewsScraper implements ResponseHandlerInterface
{
    /**
     * @var RequestApp
     */
    private $requestApp;

    /**
     * ReviewsScraper constructor.
     *
     * @param RequestApp $requestApp
     */
    public function __construct(RequestApp $requestApp)
    {
        $this->requestApp = $requestApp;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
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
