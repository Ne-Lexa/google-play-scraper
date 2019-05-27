<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

class HistogramRating
{
    /**
     * @var int
     */
    private $fiveStars;
    /**
     * @var int
     */
    private $fourStars;
    /**
     * @var int
     */
    private $threeStars;
    /**
     * @var int
     */
    private $twoStars;
    /**
     * @var int
     */
    private $oneStar;

    /**
     * HistogramRating constructor.
     *
     * @param int $fiveStars
     * @param int $fourStars
     * @param int $threeStars
     * @param int $twoStars
     * @param int $oneStar
     */
    public function __construct(int $fiveStars, int $fourStars, int $threeStars, int $twoStars, int $oneStar)
    {
        $this->fiveStars = $fiveStars;
        $this->fourStars = $fourStars;
        $this->threeStars = $threeStars;
        $this->twoStars = $twoStars;
        $this->oneStar = $oneStar;
    }

    /**
     * @return int
     */
    public function getFiveStars(): int
    {
        return $this->fiveStars;
    }

    /**
     * @return int
     */
    public function getFourStars(): int
    {
        return $this->fourStars;
    }

    /**
     * @return int
     */
    public function getThreeStars(): int
    {
        return $this->threeStars;
    }

    /**
     * @return int
     */
    public function getTwoStars(): int
    {
        return $this->twoStars;
    }

    /**
     * @return int
     */
    public function getOneStar(): int
    {
        return $this->oneStar;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "⭐⭐⭐⭐⭐ %d\n⭐⭐⭐⭐  %d\n⭐⭐⭐   %d\n⭐⭐    %d\n⭐     %d",
            $this->fiveStars,
            $this->fourStars,
            $this->threeStars,
            $this->twoStars,
            $this->oneStar
        );
    }
}
