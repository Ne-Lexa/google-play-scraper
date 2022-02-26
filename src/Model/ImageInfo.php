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
 * Contains information about the image.
 */
class ImageInfo implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string Image url. */
    private $url;

    /** @var string Local image filename. */
    private $filename;

    /** @var string Image mime-type. */
    private $mimeType;

    /** @var string Image file extension. */
    private $extension;

    /** @var int Image width. */
    private $width;

    /** @var int Image height. */
    private $height;

    /** @var int Image file size. */
    private $filesize;

    /**
     * Creates an object with information about the image saved to disk.
     *
     * @param string $url      image url
     * @param string $filename local image filename
     */
    public function __construct(string $url, string $filename)
    {
        $this->url = $url;
        $imageInfo = getimagesize($filename);

        if (!$imageInfo) {
            throw new \RuntimeException('Invalid image: ' . $filename);
        }
        $this->filename = $filename;
        $this->mimeType = $imageInfo['mime'];
        [$this->width, $this->height, $imageType] = $imageInfo;
        $this->extension = str_replace(
            'jpeg',
            'jpg',
            image_type_to_extension($imageType, false)
        );
        $this->filesize = filesize($filename);
    }

    /**
     * Returns the url of the image.
     *
     * @return string image url
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Returns the path to save the image file.
     *
     * @return string image filename
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Returns the mime type of the image.
     *
     * @return string image mime-type
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * Returns the image file extension.
     *
     * @return string image file extension
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * Returns the width of the image.
     *
     * @return int image width
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Returns the height of the image.
     *
     * @return int image height
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Returns the size of the image file.
     *
     * @return int image file size
     */
    public function getFilesize(): int
    {
        return $this->filesize;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array class properties as an array
     */
    public function asArray(): array
    {
        return [
            'url' => $this->url,
            'path' => $this->filename,
            'mimeType' => $this->mimeType,
            'extension' => $this->extension,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
