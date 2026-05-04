<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfigResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\IntegrationConfigResponse\GitHubConfig\Permission;

/**
 * @phpstan-type GitHubConfigShape = array{
 *   permission: Permission|value-of<Permission>, targetID: string
 * }
 */
final class GitHubConfig implements BaseModel
{
    /** @use SdkModel<GitHubConfigShape> */
    use SdkModel;

    /**
     * Permission to grant on the repository.
     *
     * @var value-of<Permission> $permission
     */
    #[Required(enum: Permission::class)]
    public string $permission;

    /**
     * Repository or organisation slug to grant access to.
     */
    #[Required('target_id')]
    public string $targetID;

    /**
     * `new GitHubConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GitHubConfig::with(permission: ..., targetID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GitHubConfig)->withPermission(...)->withTargetID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Permission|value-of<Permission> $permission
     */
    public static function with(
        Permission|string $permission,
        string $targetID
    ): self {
        $self = new self;

        $self['permission'] = $permission;
        $self['targetID'] = $targetID;

        return $self;
    }

    /**
     * Permission to grant on the repository.
     *
     * @param Permission|value-of<Permission> $permission
     */
    public function withPermission(Permission|string $permission): self
    {
        $self = clone $this;
        $self['permission'] = $permission;

        return $self;
    }

    /**
     * Repository or organisation slug to grant access to.
     */
    public function withTargetID(string $targetID): self
    {
        $self = clone $this;
        $self['targetID'] = $targetID;

        return $self;
    }
}
