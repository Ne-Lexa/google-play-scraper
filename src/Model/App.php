<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\Model\Builder\AppBuilder;

class App
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
    private $locale;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string|null
     */
    private $summary;
    /**
     * @var Developer
     */
    private $developer;
    /**
     * @var GoogleImage
     */
    private $icon;
    /**
     * @var float
     */
    private $score;
    /**
     * @var string|null
     */
    private $priceText;

    /**
     * App constructor.
     *
     * @param AppBuilder $builder
     * @throws \InvalidArgumentException
     */
    public function __construct(AppBuilder $builder)
    {
        $this->id = $builder->getId();
        $this->url = $builder->getUrl();
        $this->locale = $builder->getLocale();
        $this->name = $builder->getName();
        $this->summary = $builder->getSummary();
        $this->developer = $builder->getDeveloper();
        $this->icon = $builder->getIcon();
        $this->score = $builder->getScore();
        $this->priceText = $builder->getPriceText();

        if (empty($this->id)) {
            throw new \InvalidArgumentException('$id cannot be null or empty. Solution: $appBuilder->setId(...);');
        }
        if (empty($this->url)) {
            throw new \InvalidArgumentException('$url cannot be null or empty. Solution: $appBuilder->setUrl(...);');
        }
        if (empty($this->locale)) {
            throw new \InvalidArgumentException('$locale cannot be null or empty. Solution: $appBuilder->setLocale(...);');
        }
        if (empty($this->name)) {
            throw new \InvalidArgumentException('$name cannot be null or empty. Solution: $appBuilder->setName(...);');
        }
        if ($this->developer === null) {
            throw new \InvalidArgumentException('$developer cannot be null. Solution: $appBuilder->setDeveloper(...);');
        }
        if ($this->icon === null) {
            throw new \InvalidArgumentException('$icon cannot be null. Solution: $appBuilder->setIcon(...);');
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
    public function getLocale(): string
    {
        return $this->locale;
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
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @return Developer
     */
    public function getDeveloper(): Developer
    {
        return $this->developer;
    }

    /**
     * @return GoogleImage
     */
    public function getIcon(): GoogleImage
    {
        return $this->icon;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @return string|null
     */
    public function getPriceText(): ?string
    {
        return $this->priceText;
    }

    /**
     * @return bool
     */
    public function isFree(): bool
    {
        return $this->priceText === null;
    }

    /**
     * @return AppBuilder
     */
    public static function newBuilder(): AppBuilder
    {
        return new AppBuilder();
    }
}
