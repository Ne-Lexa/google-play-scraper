<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\Model\Builder\DeveloperBuilder;

class Developer
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string|null
     */
    private $description;
    /**
     * @var string|null
     */
    private $website;
    /**
     * @var GoogleImage|null
     */
    private $icon;
    /**
     * @var GoogleImage|null
     */
    private $headerImage;
    /**
     * @var string|null
     */
    private $email;
    /**
     * @var string|null
     */
    private $address;

    /**
     * @return DeveloperBuilder
     */
    public static function newBuilder(): DeveloperBuilder
    {
        return new DeveloperBuilder();
    }

    /**
     * Developer constructor.
     *
     * @param DeveloperBuilder $builder
     */
    public function __construct(DeveloperBuilder $builder)
    {
        $this->id = $builder->getId();
        $this->url = $builder->getUrl();
        $this->name = $builder->getName();
        $this->description = $builder->getDescription();
        $this->website = $builder->getWebsite();
        $this->icon = $builder->getIcon();
        $this->headerImage = $builder->getHeaderImage();
        $this->email = $builder->getEmail();
        $this->address = $builder->getAddress();

        if (empty($this->id)) {
            throw new \InvalidArgumentException('$id cannot be null or empty. Solution: $developerBuilder->setId(...);');
        }
        if (empty($this->url)) {
            throw new \InvalidArgumentException('$url cannot be null or empty. Solution: $developerBuilder->setUrl(...);');
        }
        if (empty($this->name)) {
            throw new \InvalidArgumentException('$name cannot be null or empty. Solution: $developerBuilder->setName(...);');
        }
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @return GoogleImage|null
     */
    public function getIcon(): ?GoogleImage
    {
        return $this->icon;
    }

    /**
     * @return GoogleImage|null
     */
    public function getHeaderImage(): ?GoogleImage
    {
        return $this->headerImage;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param Developer $o
     * @return bool
     */
    public function equals(Developer $o): bool
    {
        if ($this->id !== $o->id) {
            return false;
        }
        if ($this->name !== $o->name) {
            return false;
        }
        if ($this->description !== $o->description) {
            return false;
        }

        if ($this->icon !== null && $o->icon !== null) {
            if ($this->icon->getUrl() !== $o->icon->getUrl()) {
                return false;
            }
        } elseif ($this->icon !== $o->icon) {
            return false;
        }

        if ($this->headerImage !== null && $o->headerImage !== null) {
            if ($this->headerImage->getUrl() !== $o->headerImage->getUrl()) {
                return false;
            }
        } elseif ($this->headerImage !== $o->headerImage) {
            return false;
        }

        return true;
    }
}
