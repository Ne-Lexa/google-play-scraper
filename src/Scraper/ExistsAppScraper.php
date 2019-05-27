<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ExistsAppScraper implements ResponseHandlerInterface
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        return $response->getStatusCode() < 300;
    }
}
