<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\Permission;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class PermissionScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return Permission[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $contents = substr($response->getBody()->getContents(), 5);
        $json = \GuzzleHttp\json_decode($contents, true);
        $data = $json[0][2][0][65]['42656262'][1] ?? [];

        $parsePermissions = static function (array $items) use (&$parsePermissions) {
            return array_reduce(
                $items,
                static function ($results, $item) use (&$parsePermissions) {
                    if (\is_array($item)) {
                        if (\count($item) === 3 && \is_string($item[0]) && \is_string($item[1])) {
                            $results[] = new Permission($item[0], $item[1]);
                        } else {
                            $results = array_merge($results, $parsePermissions($item));
                        }
                    }

                    return $results;
                },
                []
            );
        };

        return $parsePermissions($data);
    }
}
