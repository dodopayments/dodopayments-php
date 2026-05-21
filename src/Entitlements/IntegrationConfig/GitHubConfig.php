<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfig;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\GitHubPermission;

/**
 * @phpstan-type GitHubConfigShape = array{
 *   permission: GitHubPermission|value-of<GitHubPermission>, targetID: string
 * }
 */
final class GitHubConfig implements BaseModel
{
    /** @use SdkModel<GitHubConfigShape> */
    use SdkModel;

    /**
     * Permission to grant on the repository.
     *
     * @var value-of<GitHubPermission> $permission
     */
    #[Required(enum: GitHubPermission::class)]
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
     * @param GitHubPermission|value-of<GitHubPermission> $permission
     */
    public static function with(
        GitHubPermission|string $permission,
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
     * @param GitHubPermission|value-of<GitHubPermission> $permission
     */
    public function withPermission(GitHubPermission|string $permission): self
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
