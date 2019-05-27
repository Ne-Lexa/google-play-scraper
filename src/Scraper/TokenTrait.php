<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

trait TokenTrait
{
    /**
     * @var string|null
     */
    private $token;

    /**
     * @param string|null $token
     */
    protected function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return bool
     */
    public function hasNextToken(): bool
    {
        return $this->token !== null;
    }
}
