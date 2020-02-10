<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Model;

use GuzzleHttp\Psr7\LazyOpenStream;
use Psr\Http\Message\StreamInterface;

/**
 * Class LazyStream.
 */
class LazyStream extends LazyOpenStream
{
    /**
     * @param string $from
     * @param string $to
     */
    public function replaceFilename(string $from, string $to): void
    {
        $this->filename = str_replace($from, $to, $this->filename);
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return StreamInterface
     */
    protected function createStream()
    {
        $dir = \dirname($this->getFilename());

        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        return parent::createStream();
    }
}
