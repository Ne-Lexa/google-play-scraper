<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

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
     * @return mixed Returns data which can be serialized by `json_encode()`,
     *     which is a value of any type other than a `resource`.
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php JsonSerializable::jsonSerialize
     */
    public function jsonSerialize()
    {
        return $this->asArray();
    }
}
