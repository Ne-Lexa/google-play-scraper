<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response);
}
