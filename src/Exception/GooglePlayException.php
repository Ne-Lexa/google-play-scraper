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

namespace Nelexa\GPlay\Exception;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Exception thrown if there is an error accessing the Google Play server.
 */
class GooglePlayException extends \Exception
{
    /** @var string|null URL associated with the exception. */
    private $url;

    /**
     * Construct the GooglePlayException.
     *
     * @param string     $message  the Exception message to throw
     * @param int        $code     the Exception code
     * @param \Throwable $previous the previous throwable used for the exception chaining
     */
    public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        if ($previous instanceof RequestException) {
            $this->url = $previous->getRequest()->getUri()->__toString();
        }
    }

    /**
     * Set the URL associated with the exception.
     *
     * @param string $url URL associated with the exception
     *
     * @return GooglePlayException returns the same object to support the call chain
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Returns the URL with which the exception is associated.
     *
     * URL maybe `null`.
     *
     * @return string|null URL associated with the exception or `null`
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Returns an HTTP request if present.
     *
     * @return RequestInterface|null PSR-7 `RequestInterface` or `null`
     *
     * @see https://www.php-fig.org/psr/psr-7/ PSR-7: HTTP message interfaces
     */
    public function getRequest(): ?RequestInterface
    {
        $e = $this->getPrevious();

        if ($e instanceof RequestException && $e->getRequest() !== null) {
            return $e->getRequest();
        }

        return null;
    }

    /**
     * Returns an HTTP response if present.
     *
     * @return ResponseInterface|null PSR-7 `ResponseInterface` or `null`
     *
     * @see https://www.php-fig.org/psr/psr-7/ PSR-7: HTTP message interfaces
     */
    public function getResponse(): ?ResponseInterface
    {
        $e = $this->getPrevious();

        if ($e instanceof RequestException && $e->getResponse() !== null) {
            return $e->getResponse();
        }

        return null;
    }
}
