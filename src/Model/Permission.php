<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Model;

class Permission
{
    /**
     * @var string
     */
    private $permission;
    /**
     * @var string
     */
    private $description;

    /**
     * Permission constructor.
     *
     * @param string $permission
     * @param string $description
     */
    public function __construct(string $permission, string $description)
    {
        $this->permission = $permission;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPermission(): string
    {
        return $this->permission;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
