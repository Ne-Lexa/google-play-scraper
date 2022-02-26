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

use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\HttpClient\ParseHandlerInterface;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class CategoriesScraper implements ParseHandlerInterface
{
    private const CATEGORY_URL_PREFIX = '/store/apps/category/';

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $options
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     *
     * @return array
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array &$options = []): array
    {
        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $dataCategories = null;

        foreach ($scriptData as $data) {
            if (isset($data[0][1][0][3][0]) && \is_array($data[0][1][0][3][0])) {
                $dataCategories = $data;
                break;
            }
        }

        if ($dataCategories === null) {
            throw (new GooglePlayException('Failed to get the list of categories.'))
                ->setUrl($request->getUri()->__toString())
            ;
        }

        $parseCategories = static function (array $items) use (&$parseCategories): array {
            return array_reduce(
                $items,
                static function ($results, $item) use (&$parseCategories) {
                    if (\is_array($item)) {
                        if (
                            \count($item) === 6
                            && strpos($item[0], self::CATEGORY_URL_PREFIX) === 0
                            && strpos($item[0], '?age=') === false
                        ) {
                            $id = basename($item[0]);
                            $categoryName = $item[1];
                            $results[] = new Category(
                                $id,
                                $categoryName
                            );
                        } else {
                            $results = array_merge($results, $parseCategories($item));
                        }
                    }

                    return $results;
                },
                []
            );
        };

        return $parseCategories($dataCategories[0][1][0][3]);
    }
}
