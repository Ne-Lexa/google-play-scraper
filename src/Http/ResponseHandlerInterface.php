<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response);
}
