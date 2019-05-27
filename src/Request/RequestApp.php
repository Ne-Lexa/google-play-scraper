<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Request;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Util\LocaleHelper;

class RequestApp
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $locale;
    /**
     * @var string
     */
    private $country;

    /**
     * RequestApp constructor.
     *
     * @param string $id Application id / Package name
     * @param string $locale Locale (ex. en_US, en-CA or en). Default is 'en_US'
     * @param string $country Country (affects prices). Default is 'us'.
     */
    public function __construct(
        string $id,
        string $locale = GPlayApps::DEFAULT_LOCALE,
        string $country = GPlayApps::DEFAULT_COUNTRY
    ) {
        if (empty($id)) {
            throw new \InvalidArgumentException('$id is empty');
        }
        $this->id = $id;
        $this->locale = LocaleHelper::getNormalizeLocale($locale);
        $this->country = $country;
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
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
