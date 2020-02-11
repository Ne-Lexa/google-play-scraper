<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\HttpClient\ResponseHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class SuggestScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return mixed
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $json = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);

        return array_map(
            static function (array $v) {
                return $v['s'];
            },
            $json
        );
    }
}
