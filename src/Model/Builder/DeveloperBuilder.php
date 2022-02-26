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

namespace Nelexa\GPlay\Model\Builder;

use Nelexa\GPlay\Model\GoogleImage;

/**
 * Developer Builder.
 *
 * @internal
 */
class DeveloperBuilder
{
    /** @var string|null */
    private $id;

    /** @var string|null */
    private $url;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $website;

    /** @var \Nelexa\GPlay\Model\GoogleImage|null */
    private $icon;

    /** @var \Nelexa\GPlay\Model\GoogleImage|null */
    private $cover;

    /** @var string|null */
    private $email;

    /** @var string|null */
    private $address;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     *
     * @return DeveloperBuilder
     */
    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     *
     * @return DeveloperBuilder
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return DeveloperBuilder
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return DeveloperBuilder
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     *
     * @return DeveloperBuilder
     */
    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return GoogleImage|null
     */
    public function getIcon(): ?GoogleImage
    {
        return $this->icon;
    }

    /**
     * @param GoogleImage|null $icon
     *
     * @return DeveloperBuilder
     */
    public function setIcon(?GoogleImage $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return GoogleImage|null
     */
    public function getCover(): ?GoogleImage
    {
        return $this->cover;
    }

    /**
     * @param GoogleImage|null $cover
     *
     * @return DeveloperBuilder
     */
    public function setCover(?GoogleImage $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return DeveloperBuilder
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     *
     * @return DeveloperBuilder
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
