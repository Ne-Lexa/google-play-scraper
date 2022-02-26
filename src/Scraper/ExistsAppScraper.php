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

use Nelexa\GPlay\HttpClient\ParseHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class ExistsAppScraper implements ParseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $options
     *
     * @return bool
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): bool
    {
        return $response->getStatusCode() < 300;
    }
}
