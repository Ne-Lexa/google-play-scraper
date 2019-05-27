<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

class Category
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * Category constructor.
     *
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isGamesCategory(): bool
    {
        return strpos($this->id, 'GAME') === 0;
    }

    /**
     * @return bool
     */
    public function isFamilyCategory(): bool
    {
        return strpos($this->id, 'FAMILY') === 0;
    }

    /**
     * @return bool
     */
    public function isApplicationCategory(): bool
    {
        return !$this->isGamesCategory() && !$this->isFamilyCategory();
    }
}
