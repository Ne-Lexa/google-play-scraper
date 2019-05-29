<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\Http\HttpClient;

/**
 * Google User Content URLs.
 *
 * @see https://developers.google.com/people/image-sizing
 * @see https://github.com/null-dev/libGoogleUserContent
 * @see https://sites.google.com/site/picasaresources/Home/Picasa-FAQ/google-photos-1/how-to/how-to-get-a-direct-link-to-an-image
 *
 * sN   size             Sets the longer of height or width to N pixels
 * wN   width            Sets width of image to N pixels
 * hN   height           Sets height of image to N pixels
 * c    square crop      Sets height and width of crop to the same value
 * n    ? crop           Required sets width and height
 * p    smart crop       Sets smart crop
 * bN   border           Sets border of image to N pixels
 * fv   vertical flip    Vertically flips the image
 * fh   horizontal flip  Horizontally flips the image
 * d    download         Attachment header
 *
 * Animation image:
 * aN   frame number     Sets frame number of animation image
 * k    stop animation   Without GIF animation (1 frame)
 * no   hidden play      Hidden play button if video thumbnail or animation
 *
 * Video contents:
 * mN   media format
 * m18  mp4              video, 640x360, medium
 * m22  mp4              video, 1280x720, hd720
 * m36  3gp              video, 320x180
 * m37  mp4              video, 1920x1080, full-hd
 * m140 m4a              audio, 133k
 *
 * Without parameters, s512 is used.
 *
 * Example URLs:
 *
 * https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ
 * https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ=s0-k-no
 *
 * https://lh3.googleusercontent.com/HANcKpgwKaXt380ZJKK8_YpZlGn0NcjY5os1GOJmRHQjn9x9iCz9C-_lZRUkgTHYOChGMcMuuw=w200-h300
 *
 * https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/
 * https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/w40/
 * https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/photo.jpg
 * https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s100-no/photo.jpg
 *
 * https://lh3.googleusercontent.com/-khz-7NpZXic/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reKXLHM7Pk6A7iXGRNBP8HxB0Xs1Q/w48-h48-n-mo/photo.jpg
 *
 * https://1.bp.blogspot.com/-gZoPZt6mOLQ/XMa2QFgXs6I/AAAAAAAACGs/wqldyhxSPX4PcttYLT1SB32O8-mbe5q7QCEwYBhgL/s0/top%2B40%2Bbest%2Btravel%2Bquotes.png
 *
 * https://lh4.googleusercontent.com/-0A4JtBQDKrs/VVJPnSLrOXI/AAAAAAABXR8/VFxcZF53zqk/w1134-h850-no/20141002_080237_HDR%257E2.jpg
 *
 * https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH
 * https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0-b30-fv
 * https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s100-k-no
 * https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0
 *
 * https://lh3.googleusercontent.com/proxy/3cI6bAx1WWTsIL5iPDRiPPknXImSb8xJtNuEUKGgXg8hWaGTY48kqGOdpOkLQJG1BGj3N6Y1Dc-6qvdfHoIdtk2PcwByKzpu3PkrsFIOXe-ePM9r9jPRL1lg9A=w720-h405
 *
 * https://lh3.ggpht.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g
 *
 * https://lh3.googleusercontent.com/a-/AAuE7mAndrvGgUUJNSkl3mPSa-y-XcUJch1aKZDzCD2S
 *
 * https://lh3.googleusercontent.com/BeUSIDayFKt8LBwm-xbw4gpktnthRNW7aeYo-2oqG0pIscoyablMSJpxiTfkSIkNjuiDsQ=w640-h360-k
 * https://lh3.googleusercontent.com/BeUSIDayFKt8LBwm-xbw4gpktnthRNW7aeYo-2oqG0pIscoyablMSJpxiTfkSIkNjuiDsQ=w640-h360-k-n
 *
 * https://lh4.googleusercontent.com/-2XOcvsAH-kc/VHvmCm1aOoI/AAAAAAABtzg/SDdN1Vg5FFs/s300/
 */
class GoogleImage
{
    private const PARAM_SIZE = 's';
    private const PARAM_WIDTH = 'w';
    private const PARAM_HEIGHT = 'h';
    private const PARAM_BORDER = 'b';
    private const PARAM_SQUARE_CROP = 'c';
    private const PARAM_SMART_CROP = 'p';
    private const PARAM_FLIP_VERTICAL = 'fv';
    private const PARAM_FLIP_HORIZONTAL = 'fh';

    /**
     * @var string
     */
    private $url;
    /**
     * Size longer of height or width to N pixels.
     * If set, then GoogleImage::width and GoogleImage::height are set to null.
     *
     * @var int|null
     */
    private $size;
    /**
     * Image width size up to N pixels.
     * If set, then GoogleImage::size is null.
     *
     * @var int|null
     */
    private $width;
    /**
     * Image height size up to N pixels.
     * If set, then GoogleImage::size is null.
     *
     * @var int|null
     */
    private $height;
    /**
     * @var int|null
     */
    private $border;
    /**
     * @var bool
     */
    private $squareCrop = false;
    /**
     * @var bool
     */
    private $smartCrop = false;
    /**
     * @var bool
     */
    private $verticalFlip = false;
    /**
     * @var bool
     */
    private $horizontalFlip = false;
    /**
     * Variant URL with file name at the end.
     * A special URL structure is used.
     * URL starts with /-
     *
     * Example URL:
     * https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s100-no/photo.jpg
     *
     * @var bool
     * @internal
     */
    private $variantOfUrlWithFileName = false;

    /**
     * @param string $url google image url
     * @param bool $keepParams keep url params
     */
    public function __construct(string $url, bool $keepParams = true)
    {
        $httpComponents = parse_url($url);
        $path = ltrim($httpComponents['path'], '/');
        $parts = explode('/', $path);
        $paramString = null;
        if (count($parts) > 4 && strpos($parts[0], '-') === 0) {
            if (isset($parts[5]) || (isset($parts[4]) && strrpos($url, '/') === strlen($url) - 1)) {
                $paramString = $parts[4];
            }
            $parts = array_slice($parts, 0, 4);
            $path = implode('/', $parts);
            $url = $httpComponents['scheme'] . '://' . $httpComponents['host'] . '/' . $path . '/';
            $this->variantOfUrlWithFileName = true;
        } elseif (($pos = strpos($url, '=')) !== false) {
            $paramString = substr($url, $pos + 1);
            $url = substr($url, 0, $pos);
        }

        $this->url = $url;
        if ($keepParams && $paramString !== null) {
            $this->parseParams($paramString);
        }
    }

    /**
     * @param string $paramString
     * @internal
     */
    private function parseParams(string $paramString): void
    {
        $params = explode('-', $paramString);
        foreach ($params as $param) {
            if (empty($param)) {
                continue;
            }

            $command = $param[0]; // 1 char
            switch ($command) {
                case self::PARAM_SIZE:
                    $arg = (int)substr($param, 1);
                    $this->setSize($arg);
                    break;
                case self::PARAM_WIDTH:
                    $arg = (int)substr($param, 1);
                    $this->setWidth($arg);
                    break;
                case self::PARAM_HEIGHT:
                    $arg = (int)substr($param, 1);
                    $this->setHeight($arg);
                    break;
                case self::PARAM_BORDER:
                    $arg = (int)substr($param, 1);
                    $this->setBorder($arg);
                    break;
                case self::PARAM_SQUARE_CROP:
                    $this->setSquareCrop(true);
                    break;
                case self::PARAM_SMART_CROP:
                    $this->setSmartCrop(true);
                    break;
                default:
                    switch ($param) {
                        case self::PARAM_FLIP_VERTICAL:
                            $this->setVerticalFlip(true);
                            break;
                        case self::PARAM_FLIP_HORIZONTAL:
                            $this->setHorizontalFlip(true);
                            break;
                        // ignore other parameters
                    }
            }
        }
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        $params = [];
        if ($this->size !== null) {
            $params[] = self::PARAM_SIZE . $this->size;
        } else {
            if ($this->width !== null) {
                $params[] = self::PARAM_WIDTH . $this->width;
            }
            if ($this->height !== null) {
                $params[] = self::PARAM_HEIGHT . $this->height;
            }
        }

        if ($this->isValidSmartCrop()) {
            $params[] = self::PARAM_SMART_CROP;
        } elseif ($this->squareCrop) {
            $params[] = self::PARAM_SQUARE_CROP;
        }

        if ($this->variantOfUrlWithFileName) {
            if (empty($params)) {
                return $this->url;
            }
            return $this->url . implode('-', $params) . '/';
        }

        if ($this->border !== null) {
            $params[] = self::PARAM_BORDER . $this->border;
        }

        if ($this->verticalFlip) {
            $params[] = self::PARAM_FLIP_VERTICAL;
        }

        if ($this->horizontalFlip) {
            $params[] = self::PARAM_FLIP_HORIZONTAL;
        }

        if (empty($params)) {
            return $this->url;
        }
        return $this->url . '=' . implode('-', $params);
    }

    /**
     * @return bool
     */
    private function isValidSmartCrop(): bool
    {
        return $this->smartCrop && (
            $this->size !== null ||
                ($this->width !== null && $this->height !== null) ||
                ($this->size === null && $this->width === null && $this->height === null)
            );
    }

    /**
     * Returns the URL with the best image size.
     *
     * @return string url
     */
    public function getBestSizeUrl(): string
    {
        $params = [self::PARAM_SIZE . '0'];
        if ($this->variantOfUrlWithFileName) {
            return $this->url . implode('-', $params) . '/';
        }
        return $this->url . '=' . implode('-', $params);
    }

    /**
     * Returns a hash value for this object.
     * Can be used to generate a file save path.
     *
     * @param string $hashAlgorithm Hash algorithm. Default is md5.
     * @param int $parts Nesting path. Maximum 6.
     * @param int $partLength The length of the nested path.
     * @return string unique hash value of this object
     */
    public function getHashUrl(string $hashAlgorithm = 'md5', int $parts = 1, int $partLength = 2): string
    {
        $hash = hash($hashAlgorithm, $this->getUrl());
        $hashLength = strlen($hash);
        $parts = max(1, min(6, $parts));
        if ($parts > 1) {
            $partLength = max(1, min($partLength, (int)($hashLength / $parts)));
            $partsBuild = [];
            for ($i = 0; $i < $parts; $i++) {
                $partsBuild[] = substr($hash, $i * $partLength, $partLength);
            }
            $hash = implode('/', $partsBuild) . '/' . $hash;
        }
        return $hash;
    }

    /**
     * Sets the original image size.
     *
     * @return GoogleImage
     */
    public function useOriginalSize(): GoogleImage
    {
        $this->setSize(0);
        return $this;
    }

    /**
     * @param int|null $size
     * @return GoogleImage
     */
    public function setSize(?int $size): GoogleImage
    {
        $this->size = $size;
        $this->width = null;
        $this->height = null;
        return $this;
    }

    /**
     * @param int|null $width
     * @return GoogleImage
     */
    public function setWidth(?int $width): GoogleImage
    {
        $this->width = $width;
        $this->size = null;
        return $this;
    }

    /**
     * @param int|null $height
     * @return GoogleImage
     */
    public function setHeight(?int $height): GoogleImage
    {
        $this->height = $height;
        $this->size = null;
        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return GoogleImage
     */
    public function setWidthAndHeight(int $width, int $height): GoogleImage
    {
        $this->width = $width;
        $this->height = $height;
        $this->size = null;
        return $this;
    }

    /**
     * @param int|null $border
     * @return GoogleImage
     */
    public function setBorder(?int $border): GoogleImage
    {
        $this->border = $border;
        return $this;
    }

    /**
     * @param bool $squareCrop
     * @return GoogleImage
     */
    public function setSquareCrop(bool $squareCrop): GoogleImage
    {
        $this->squareCrop = $squareCrop;
        $this->smartCrop = false;
        return $this;
    }

    /**
     * @param bool $smartCrop
     * @return GoogleImage
     */
    public function setSmartCrop(bool $smartCrop): GoogleImage
    {
        $this->smartCrop = $smartCrop;
        $this->squareCrop = false;
        return $this;
    }

    /**
     * @param bool $verticalFlip
     * @return GoogleImage
     */
    public function setVerticalFlip(bool $verticalFlip): GoogleImage
    {
        $this->verticalFlip = $verticalFlip;
        return $this;
    }

    /**
     * @param bool $horizontalFlip
     * @return GoogleImage
     */
    public function setHorizontalFlip(bool $horizontalFlip): GoogleImage
    {
        $this->horizontalFlip = $horizontalFlip;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @return int|null
     */
    public function getBorder(): ?int
    {
        return $this->border;
    }

    /**
     * @return bool
     */
    public function isSquareCrop(): bool
    {
        return $this->squareCrop;
    }

    /**
     * @return bool
     */
    public function isSmartCrop(): bool
    {
        return $this->smartCrop;
    }

    /**
     * @return bool
     */
    public function isVerticalFlip(): bool
    {
        return $this->verticalFlip;
    }

    /**
     * @return bool
     */
    public function isHorizontalFlip(): bool
    {
        return $this->horizontalFlip;
    }

    public function reset(): void
    {
        $this->size = null;
        $this->width = null;
        $this->height = null;
        $this->border = null;
        $this->squareCrop = false;
        $this->smartCrop = false;
        $this->verticalFlip = false;
        $this->horizontalFlip = false;
    }

    /**
     * @param string $destPath
     * @return ImageInfo
     * @throws GooglePlayException
     */
    public function saveAs(string $destPath): ImageInfo
    {
        static $httpClient;

        if ($httpClient === null) {
            $httpClient = new HttpClient();
        }

        $url = $this->getUrl();

        $dirName = dirname($destPath);
        if (!is_dir($dirName) && !mkdir($dirName, 0755, true) && !is_dir($dirName)) {
            throw new \RuntimeException(sprintf('Failed to create "%s"', $dirName));
        }

        try {
            $httpClient->request('GET', $url, [
                RequestOptions::SINK => $destPath,
                RequestOptions::HTTP_ERRORS => true,
            ]);

            return new ImageInfo($url, $destPath);
        } catch (\Throwable|GuzzleException $e) {
            if (is_file($destPath)) {
                unlink($destPath);
            }
            $ge = new GooglePlayException($e->getMessage(), $e->getCode(), $e);
            $ge->setUrl($url);
            throw $ge;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getUrl();
    }
}
