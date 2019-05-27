<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

class ReplyReview
{
    /**
     * @var \DateTimeInterface
     */
    private $date;
    /**
     * @var string
     */
    private $text;

    /**
     * ReplyReview constructor.
     *
     * @param \DateTimeInterface $date
     * @param string $text
     */
    public function __construct(\DateTimeInterface $date, string $text)
    {
        $this->date = $date;
        $this->text = $text;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
