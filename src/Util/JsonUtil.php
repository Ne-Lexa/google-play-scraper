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

namespace Nelexa\GPlay\Util;

class JsonUtil
{
    public static function recursiveJson($json, string $path = ''): string
    {
        if (\is_array($json)) {
            $return = '';
            foreach ($json as $key => $i) {
                $return .= self::recursiveJson($i, $path . '[' . $key . ']');
            }

            return $return;
        }

        return $path . ' => ' . $json . \PHP_EOL;
    }
}
