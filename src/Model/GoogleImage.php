<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

use GuzzleHttp\RequestOptions;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\Util\LazyStream;
use Nelexa\HttpClient\HttpClient;
use Psr\Http\Message\ResponseInterface;

/**
 * Contains a link to the image, allows you to customize its size and download it.
 *
 * This class only works with images stored on googleusercontent.com.
 * To modify the image, special parameters are added to the URL, using a hyphen.
 *
 * **Supported parameters:**
 *
 * | Param | Name         | Description                                     | Example                       |
 * | :---: |:------------ | :---------------------------------------------- | ----------------------------: |
 * | sN | size            | Sets the longer of height or width to N pixels  | s70 ![][_s] ![][_s2] ![][_s3] |
 * | wN | width           | Sets width of image to N pixels                 | w70 ![][_w] ![][_w2] ![][_w3] |
 * | hN | height          | Sets height of image to N pixels                | h70 ![][_h] ![][_h2] ![][_h3] |
 * | c  | square crop     | Sets square crop                   | w40-h70-c ![][_c1.1] ![][_c1.2] ![][_c1.3] |
 * |    |                 |                                    | w70-h40-c ![][_c2.1] ![][_c2.2] ![][_c2.3] |
 * |    |                 |                                    | w70-h70-c ![][_c3.1] ![][_c3.2] ![][_c3.3] |
 * | p  | smart crop      | Sets smart crop                    | w40-h70-p ![][_p1.1] ![][_p1.2] ![][_p1.3] |
 * |    |                 |                                    | w70-h40-p ![][_p2.1] ![][_p2.2] ![][_p2.3] |
 * |    |                 |                                    | w70-h70-p ![][_p3.1] ![][_p3.2] ![][_p3.3] |
 * | bN | border          | Sets border of image to N pixels            | s70-b10 ![][_b] ![][_b2] ![][_b3] |
 * | fv | vertical flip   | Vertically flips the image                | s70-fv ![][_fv] ![][_fv2] ![][_fv3] |
 * | fh | horizontal flip | Horizontally flips the image              | s70-fh ![][_fh] ![][_fh2] ![][_fh3] |
 *
 * [_s]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70
 * [_w]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70
 * [_h]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=h70
 * [_c1.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w40-h70-c
 * [_c2.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h40-c
 * [_c3.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h70-c
 * [_p1.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w40-h70-p
 * [_p2.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h40-p
 * [_p3.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h70-p
 * [_b]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70-b10
 * [_fv]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70-fv
 * [_fh]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70-fh
 *
 * [_s2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70
 * [_w2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70
 * [_h2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=h70
 * [_c1.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w40-h70-c
 * [_c2.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h40-c
 * [_c3.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h70-c
 * [_p1.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w40-h70-p
 * [_p2.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h40-p
 * [_p3.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h70-p
 * [_b2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70-b10
 * [_fv2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70-fv
 * [_fh2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70-fh
 *
 * [_s3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70
 * [_w3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70
 * [_h3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=h70
 * [_c1.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w40-h70-c
 * [_c2.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h40-c
 * [_c3.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h70-c
 * [_p1.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w40-h70-p
 * [_p2.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h40-p
 * [_p3.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h70-p
 * [_b3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70-b10
 * [_fv3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70-fv
 * [_fh3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70-fh
 *
 * If the URL has no parameters, by default GoogleUserContents uses the parameter **s512**.
 * This means that the width or height will not exceed 512px.
 *
 * @see https://developers.google.com/people/image-sizing Goolge People API - Image Sizing.
 * @see https://github.com/null-dev/libGoogleUserContent Java library to create googleusercontent.com URLs.
 * @see https://sites.google.com/site/picasaresources/Home/Picasa-FAQ/google-photos-1/how-to/how-to-get-a-direct-link-to-an-image
 *      Google Photos and Picasa: How to get a direct link to an image (of a specific size)
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

    /** @var string Base URL without parameters and file name. */
    private $baseUrl;

    /** @var int|null Size longer of height or width to N pixels or `null`. */
    private $size;

    /** @var int|null Image width size up to N pixels. */
    private $width;

    /** @var int|null Image height size up to N pixels. */
    private $height;

    /** @var int|null Image border size or `null`. */
    private $border;

    /**
     * Using square crop.
     *
     * When cropping, only the center of the image is saved.
     *
     * @var bool using square crop
     */
    private $squareCrop = false;

    /**
     * Using smart crop.
     *
     * When cropping, some algorithm searches for the most interesting part of the image,
     * so the result of cropping does not always preserve the center of the image.
     *
     * @var bool using smart crop
     */
    private $smartCrop = false;

    /** @var bool Vertical flip effect */
    private $verticalFlip = false;

    /** @var bool Horizontal flip effect */
    private $horizontalFlip = false;

    /**
     * Variant URL with file name at the end.
     *
     * A special URL structure is used. URL starts with /-.
     *
     * Example URL:
     * https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s100-no/photo.jpg
     *
     * @var bool special URL structure is used
     */
    private $variantOfUrlWithFileName = false;

    /**
     * Creates a GoogleImage object from the URL of the googleusercontent.com.
     *
     * @param string $url        URL image of googleusercontent.com server
     * @param bool   $keepParams keep parameters from URL
     */
    public function __construct(string $url, bool $keepParams = true)
    {
        $httpComponents = parse_url($url);

        if (
            !isset($httpComponents['host']) ||
            !preg_match('~\.(googleusercontent\.com|ggpht\.com|bp\.blogspot\.com)$~i', $httpComponents['host'])
        ) {
            throw new \InvalidArgumentException(sprintf('Unsupported URL: %s', $url));
        }
        $path = ltrim($httpComponents['path'], '/');
        $parts = explode('/', $path);
        $paramString = null;

        if (\count($parts) > 4 && strpos($parts[0], '-') === 0) {
            if (isset($parts[5]) || (isset($parts[4]) && strrpos($url, '/') === \strlen($url) - 1)) {
                $paramString = $parts[4];
            }
            $parts = \array_slice($parts, 0, 4);
            $path = implode('/', $parts);
            $url = $httpComponents['scheme'] . '://' . $httpComponents['host'] . '/' . $path . '/';
            $this->variantOfUrlWithFileName = true;
        } elseif (($pos = strpos($url, '=')) !== false) {
            $paramString = substr($url, $pos + 1);
            $url = substr($url, 0, $pos);
        }

        $this->baseUrl = $url;

        if ($keepParams && $paramString !== null) {
            $this->parseParams($paramString);
        }
    }

    /**
     * @param string $paramString Image parameters
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
                    $arg = (int) substr($param, 1);
                    $this->setSize($arg);
                    break;

                case self::PARAM_WIDTH:
                    $arg = (int) substr($param, 1);
                    $this->setWidth($arg);
                    break;

                case self::PARAM_HEIGHT:
                    $arg = (int) substr($param, 1);
                    $this->setHeight($arg);
                    break;

                case self::PARAM_BORDER:
                    $arg = (int) substr($param, 1);
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
     * Returns the URL of the image with all the parameters set.
     *
     * @return string image URL
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
                return $this->baseUrl;
            }

            return $this->baseUrl . implode('-', $params) . '/';
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
            return $this->baseUrl;
        }

        return $this->baseUrl . '=' . implode('-', $params);
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
     * Returns a URL with the original image size.
     *
     * @return string URL of the original image size
     */
    public function getOriginalSizeUrl(): string
    {
        $params = [self::PARAM_SIZE . '0'];

        if ($this->variantOfUrlWithFileName) {
            return $this->baseUrl . implode('-', $params) . '/';
        }

        return $this->baseUrl . '=' . implode('-', $params);
    }

    /**
     * Returns a hash value for this object.
     * Can be used to generate a file save path.
     *
     * @param string $hashAlgorithm Hash algorithm. Default is md5.
     * @param int    $parts         Nesting path. Maximum 6.
     * @param int    $partLength    the length of the nested path
     *
     * @return string unique hash value of this object
     */
    public function getHashUrl(string $hashAlgorithm = 'md5', int $parts = 0, int $partLength = 2): string
    {
        $hash = hash($hashAlgorithm, $this->getUrl());
        $hashLength = \strlen($hash);
        $parts = max(0, min(6, $parts));

        if ($parts > 0) {
            $partLength = max(1, min($partLength, (int) ($hashLength / $parts)));
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
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function useOriginalSize(): self
    {
        $this->setSize(0);

        return $this;
    }

    /**
     * Sets the image size greater than height or width up to N pixels.
     *
     * @param int|null $size width or height of the image in pixels
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setSize(?int $size): self
    {
        $this->size = $size;
        $this->width = null;
        $this->height = null;

        return $this;
    }

    /**
     * Sets the width of the image.
     *
     * @param int|null $width image width
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setWidth(?int $width): self
    {
        $this->width = $width;
        $this->size = null;

        return $this;
    }

    /**
     * Sets the height of the image.
     *
     * @param int|null $height image height
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setHeight(?int $height): self
    {
        $this->height = $height;
        $this->size = null;

        return $this;
    }

    /**
     * Sets the width and height of the image.
     *
     * @param int $width  image width
     * @param int $height image height
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setWidthAndHeight(int $width, int $height): self
    {
        $this->width = $width;
        $this->height = $height;
        $this->size = null;

        return $this;
    }

    /**
     * Sets the border around the image.
     *
     * @param int|null $border the number of pixels of the border
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setBorder(?int $border): self
    {
        $this->border = $border;

        return $this;
    }

    /**
     * Sets the use of square crop.
     *
     * @param bool $squareCrop square crop
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setSquareCrop(bool $squareCrop): self
    {
        $this->squareCrop = $squareCrop;
        $this->smartCrop = false;

        return $this;
    }

    /**
     * Sets the use of smart crop.
     *
     * @param bool $smartCrop smart crop
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setSmartCrop(bool $smartCrop): self
    {
        $this->smartCrop = $smartCrop;
        $this->squareCrop = false;

        return $this;
    }

    /**
     * Sets the use of vertical flip.
     *
     * @param bool $verticalFlip vertical flip
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setVerticalFlip(bool $verticalFlip): self
    {
        $this->verticalFlip = $verticalFlip;

        return $this;
    }

    /**
     * Sets the use of horizontal flip.
     *
     * @param bool $horizontalFlip horizontal flip
     *
     * @return GoogleImage returns the same object \Nelexa\GPlay\Model\GoogleImage to support the call chain
     */
    public function setHorizontalFlip(bool $horizontalFlip): self
    {
        $this->horizontalFlip = $horizontalFlip;

        return $this;
    }

    /**
     * @return int|null
     * @ignore
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return int|null
     * @ignore
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @return int|null
     * @ignore
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @return int|null
     * @ignore
     */
    public function getBorder(): ?int
    {
        return $this->border;
    }

    /**
     * @return bool
     * @ignore
     */
    public function isSquareCrop(): bool
    {
        return $this->squareCrop;
    }

    /**
     * @return bool
     * @ignore
     */
    public function isSmartCrop(): bool
    {
        return $this->smartCrop;
    }

    /**
     * @return bool
     * @ignore
     */
    public function isVerticalFlip(): bool
    {
        return $this->verticalFlip;
    }

    /**
     * @return bool
     * @ignore
     */
    public function isHorizontalFlip(): bool
    {
        return $this->horizontalFlip;
    }

    /**
     * Reset all parameters.
     */
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
     * Save image to disk.
     *
     * @param string $destPath output filename
     *
     * @throws GooglePlayException if the error is HTTP or save to disk
     *
     * @return ImageInfo returns the object {@see ImageInfo}
     *
     * @see ImageInfo Contains information about the image.
     */
    public function saveAs(string $destPath): ImageInfo
    {
        $url = $this->getUrl();

        $stream = new LazyStream($destPath, 'w+b');

        try {
            $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::COOKIES => null,
                    RequestOptions::HTTP_ERRORS => true,
                    RequestOptions::SINK => $stream,
                    RequestOptions::ON_HEADERS => static function (ResponseInterface $response) use (
                        $url,
                        $stream
                    ): void {
                        self::onHeaders($response, $url, $stream);
                    },
                ]
            );

            return new ImageInfo($url, $stream->getFilename());
        } catch (\Throwable $e) {
            if (is_file($destPath)) {
                unlink($destPath);
            }
            $ge = new GooglePlayException($e->getMessage(), 1, $e);
            $ge->setUrl($url);

            throw $ge;
        }
    }

    /**
     * @param ResponseInterface $response
     * @param string            $url
     * @param LazyStream        $stream
     *
     * @throws GooglePlayException
     *
     * @internal
     */
    public static function onHeaders(ResponseInterface $response, string $url, LazyStream $stream): void
    {
        if ($response->getStatusCode() >= 400) {
            return;
        }

        $contentType = $response->getHeaderLine('Content-Type');

        if (!preg_match('~\bimage/.*\b~i', $contentType, $match)) {
            throw new GooglePlayException('Url ' . $url . ' is not image');
        }
        $contentType = $match[0];
        $imageType = self::getImageExtension($contentType);
        $stream->replaceFilename('{ext}', $imageType);
    }

    /**
     * @param string $mimeType
     *
     * @return string|null
     */
    public static function getImageExtension(string $mimeType): ?string
    {
        switch ($mimeType) {
            case 'image/gif':
                return 'gif';

            case 'image/jpeg':
                return 'jpg';

            case 'image/png':
                return 'png';

            case 'image/webp':
                return 'webp';

            default:
                return null;
        }
    }

    /**
     * @return HttpClient
     */
    private function getHttpClient(): HttpClient
    {
        static $httpClient;

        if ($httpClient === null) {
            $httpClient = new HttpClient();
        }

        return $httpClient;
    }

    /**
     * Returns binary image contents.
     *
     * @throws GooglePlayException if an HTTP error occurred
     *
     * @return string binary image content
     */
    public function getBinaryImageContent(): string
    {
        $url = $this->getUrl();

        try {
            $response = $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::HTTP_ERRORS => true,
                ]
            );

            return $response->getBody()->getContents();
        } catch (\Throwable $e) {
            $ge = new GooglePlayException($e->getMessage(), 1, $e);
            $ge->setUrl($url);

            throw $ge;
        }
    }

    /**
     * @return array
     * @ignore
     */
    public function __debugInfo()
    {
        return [
            'url' => $this->getUrl(),
        ];
    }

    /**
     * Returns the URL of the image.
     *
     * This method is equivalent to {@see GoogleImage::getUrl()}.
     *
     * @return string image URL
     */
    public function __toString()
    {
        return $this->getUrl();
    }
}
