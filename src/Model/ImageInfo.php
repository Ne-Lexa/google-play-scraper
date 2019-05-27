<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

class ImageInfo
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $mimeType;
    /**
     * @var string
     */
    private $extension;
    /**
     * @var int
     */
    private $width;
    /**
     * @var int
     */
    private $height;
    /**
     * @var int
     */
    private $filesize;

    /**
     * ImageInfo constructor.
     *
     * @param string $url
     * @param string $path
     */
    public function __construct(string $url, string $path)
    {
        $this->url = $url;
        $imageInfo = getimagesize($path);
        if (!$imageInfo) {
            throw new \RuntimeException('Invalid image: ' . $path);
        }
        $this->path = $path;
        $this->mimeType = $imageInfo['mime'];
        $this->extension = str_replace(
            'jpeg',
            'jpg',
            image_type_to_extension($imageInfo[2], false)
        );
        $this->width = $imageInfo[0];
        $this->height = $imageInfo[1];
        $this->filesize = filesize($path);
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getFilesize(): int
    {
        return $this->filesize;
    }
}
