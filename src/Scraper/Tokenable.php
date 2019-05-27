<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

interface Tokenable
{
    /**
     * @return string|null
     */
    public function getToken(): ?string;

    public function hasNextToken(): bool;
}
