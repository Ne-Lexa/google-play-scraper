<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Exception;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class GooglePlayException extends \Exception
{
    /**
     * @var string|null
     */
    private $url;

    /**
     * GooglePlayException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable $previous
     */
    public function __construct($message = '', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        if (($previous instanceof RequestException) && $previous->getRequest() !== null) {
            $this->url = $previous->getRequest()->getUri()->__toString();
        }
    }

    /**
     * @param string $url
     * @return GooglePlayException
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return ResponseInterface|null
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
