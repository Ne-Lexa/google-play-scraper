<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Model;

/**
 * Trait JsonSerializableTrait.
 */
trait JsonSerializableTrait
{
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
     * @return mixed returns data which can be serialized by `json_encode()`,
     *               which is a value of any type other than a `resource`
     *
     * @see https://php.net/manual/en/jsonserializable.jsonserialize.php JsonSerializable::jsonSerialize
     */
    public function jsonSerialize()
    {
        return $this->asArray();
    }

    /**
     * @return array
     *
     * @internal
     */
    public function __debugInfo()
    {
        return $this->asArray();
    }
}
