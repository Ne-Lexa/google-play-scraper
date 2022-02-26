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

namespace Nelexa\GPlay\HttpClient;

use Psr\Http\Message\RequestInterface;

class Request
{
    /** @var \Psr\Http\Message\RequestInterface */
    private $psrRequest;

    /** @var array */
    private $options;

    /** @var \Closure<RequestInterface, \Psr\Http\Message\ResponseInterface, array>|callable<RequestInterface, \Psr\Http\Message\ResponseInterface, array>|ParseHandlerInterface */
    private $parseHandler;

    /**
     * @param \Psr\Http\Message\RequestInterface                                                                                                                                  $psrRequest
     * @param array                                                                                                                                                               $options
     * @param \Closure<RequestInterface, \Psr\Http\Message\ResponseInterface, array>|callable<RequestInterface, \Psr\Http\Message\ResponseInterface, array>|ParseHandlerInterface $parseHandler
     */
    public function __construct(RequestInterface $psrRequest, array $options, $parseHandler)
    {
        $this->psrRequest = $psrRequest;
        $this->options = $options;
        $this->parseHandler = $parseHandler;
    }

    /**
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getPsrRequest(): RequestInterface
    {
        return $this->psrRequest;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return \Closure<RequestInterface, \Psr\Http\Message\ResponseInterface, array>|callable<RequestInterface, \Psr\Http\Message\ResponseInterface, array>|ParseHandlerInterface
     */
    public function getParseHandler()
    {
        return $this->parseHandler;
    }
}
