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

final class HashUtil
{
    /**
     * Returns request hash.
     *
     * @param RequestInterface $request  Request
     * @param string           $hashAlgo Hash algo
     *
     * @return string hash
     */
    public static function getRequestHash(RequestInterface $request, string $hashAlgo = 'crc32b'): string
    {
        $ctx = hash_init($hashAlgo);
        hash_update($ctx, $request->getMethod());
        hash_update($ctx, (string) $request->getUri());

        foreach ($request->getHeaders() as $name => $header) {
            hash_update($ctx, $name . ': ' . implode(', ', $header));
        }
        hash_update($ctx, $request->getBody()->getContents());

        return hash_final($ctx);
    }

    /**
     * @param callable $func     Callable, function name, class name or object
     * @param string   $hashAlgo Hash algorithm
     *
     * @throws \ReflectionException
     *
     * @return string
     */
    public static function hashCallable(callable $func, string $hashAlgo = 'crc32b'): string
    {
        if (\is_object($func)) {
            return self::generateHashByCallableObject($func, $hashAlgo);
        }

        if (\is_string($func) && strpos($func, '::') !== false) {
            $func = explode('::', $func, 2);
        }

        if (\is_array($func) && \count($func) === 2) {
            [$classRef, $method] = $func;
            $ref = (new \ReflectionClass($classRef))->getMethod($method);
        } elseif (\is_string($func)) {
            if (class_exists($func, false)) {
                $ref = new \ReflectionClass($func);
            } elseif (\function_exists($func)) {
                $ref = new \ReflectionFunction($func);
            }
        }

        if (!isset($ref)) {
            throw new \RuntimeException('Could not calculate hash for passed callable.');
        }

        return self::generateHashByReflection($ref, $hashAlgo);
    }

    /**
     * @param callable|object $func
     * @param string          $hashAlgo Hash algorithm
     *
     * @throws \ReflectionException
     *
     * @return string
     */
    private static function generateHashByCallableObject(callable $func, string $hashAlgo): string
    {
        static $hashes;

        if ($hashes === null) {
            $hashes = new \SplObjectStorage();
        }

        if (!isset($hashes[$func])) {
            $hashContents = false;

            if ($func instanceof \Closure) {
                $ref = new \ReflectionFunction($func);
                $hashContents = true;
            } else {
                $ref = new \ReflectionClass($func);

                if ($ref->isAnonymous()) {
                    $hashContents = true;
                }
            }

            $ctx = hash_init($hashAlgo);

            if ($ref->isUserDefined()) {
                if ($hashContents) {
                    $file = new \SplFileObject($ref->getFileName());
                    $file->seek($ref->getStartLine() - 1);

                    while ($file->key() < $ref->getEndLine()) {
                        hash_update($ctx, $file->current());
                        $file->next();
                    }
                } else {
                    hash_update(
                        $ctx,
                        $ref->getName() . \PHP_EOL
                        . $ref->getFileName() . \PHP_EOL
                        . filemtime($ref->getFileName())
                    );
                }
            } else {
                hash_update($ctx, $ref->getName());
            }
            $hashes[$func] = hash_final($ctx);
        }

        return (string) $hashes[$func];
    }

    /**
     * @param \ReflectionClass|\ReflectionFunction|\ReflectionMethod $ref
     * @param string                                                 $hashAlgo
     *
     * @return string
     */
    private static function generateHashByReflection($ref, string $hashAlgo): string
    {
        static $hashes = [];

        if (!isset($hashes[$ref->getName()])) {
            if ($ref->isUserDefined()) {
                $hashes[$ref->getName()] = hash(
                    $hashAlgo,
                    $ref->getName() . \PHP_EOL
                    . $ref->getFileName() . \PHP_EOL
                    . filemtime($ref->getFileName())
                );
            } else {
                $hashes[$ref->getName()] = hash($hashAlgo, $ref->getName());
            }
        }

        return $hashes[$ref->getName()];
    }
}
