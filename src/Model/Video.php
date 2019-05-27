<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

class Video
{
    /**
     * @var string
     */
    private $thumb;
    /**
     * @var string
     */
    private $url;

    /**
     * Video constructor.
     *
     * @param string $thumb
     * @param string $url
     */
    public function __construct(string $thumb, string $url)
    {
        $this->thumb = $thumb;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return $this->thumb;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getYoutubeId(): ?string
    {
        if (preg_match('~^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*~', $this->url, $match)) {
            return $match[1];
        }
        return null;
    }
}
