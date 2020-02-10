<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

/**
 * Contains information about application permissions.
 */
class Permission implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string Permission label. */
    private $label;

    /** @var GoogleImage */
    private $icon;

    /** @var string[] Permissions. */
    private $permissions;

    /**
     * Permission constructor.
     *
     * @param string      $label
     * @param GoogleImage $icon
     * @param string[]    $permissions
     */
    public function __construct(string $label, GoogleImage $icon, array $permissions)
    {
        $this->label = $label;
        $this->icon = $icon;
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return GoogleImage
     */
    public function getIcon(): GoogleImage
    {
        return $this->icon;
    }

    /**
     * @return string[]
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array class properties as an array
     */
    public function asArray(): array
    {
        return [
            'label' => $this->label,
            'icon' => $this->icon->getUrl(),
            'permissions' => $this->permissions,
        ];
    }
}
