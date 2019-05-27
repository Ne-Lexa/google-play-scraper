<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

class Review
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
    private $userName;
    /**
     * @var string
     */
    private $text;
    /**
     * @var GoogleImage
     */
    private $avatar;
    /**
     * @var \DateTimeInterface
     */
    private $date;
    /**
     * @var int
     */
    private $score;
    /**
     * @var int
     */
    private $likeCount;
    /**
     * @var ReplyReview|null
     */
    private $reply;

    /**
     * Review constructor.
     *
     * @param string $id
     * @param string $url
     * @param string $userName
     * @param string $text
     * @param GoogleImage $avatar
     * @param \DateTimeInterface $date
     * @param int $score
     * @param int $likeCount
     * @param ReplyReview|null $reply
     */
    public function __construct(
        string $id,
        string $url,
        string $userName,
        string $text,
        GoogleImage $avatar,
        \DateTimeInterface $date,
        int $score,
        int $likeCount = 0,
        ?ReplyReview $reply = null
    ) {
        $this->id = $id;
        $this->url = $url;
        $this->userName = $userName;
        $this->text = $text;
        $this->avatar = $avatar;
        $this->date = $date;
        $this->score = $score;
        $this->likeCount = $likeCount;
        $this->reply = $reply;
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
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return GoogleImage
     */
    public function getAvatar(): GoogleImage
    {
        return $this->avatar;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return int
     */
    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    /**
     * @return ReplyReview|null
     */
    public function getReply(): ?ReplyReview
    {
        return $this->reply;
    }
}
