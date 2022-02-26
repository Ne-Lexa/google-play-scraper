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

namespace Nelexa\GPlay\Model;

/**
 * Trait JsonSerializableTrait.
 */
trait JsonSerializableTrait
{
    /**
     * @return array
     *
     * @internal
     */
    public function __debugInfo(): array
    {
        return $this->asArray();
    }

    /**
     * Returns class properties as an array.
     *
     * @return array
     */
    abstract public function asArray(): array;

    /**
     * Specify data which should be serialized to JSON.
     *
     * Serializes the object to a value that can be serialized natively by `json_encode()`.
     *
     * @return array returns data which can be serialized by `json_encode()`,
     *               which is a value of any type other than a `resource`
     *
     * @see https://php.net/manual/en/jsonserializable.jsonserialize.php JsonSerializable::jsonSerialize
     */
    public function jsonSerialize(): array
    {
        return $this->asArray();
    }
}
