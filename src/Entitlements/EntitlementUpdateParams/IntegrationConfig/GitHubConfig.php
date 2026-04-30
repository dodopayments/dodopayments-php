<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type GitHubConfigShape = array{permission: string, targetID: string}
 */
final class GitHubConfig implements BaseModel
{
    /** @use SdkModel<GitHubConfigShape> */
    use SdkModel;

    /**
     * One of: pull, push, admin, maintain, triage.
     */
    #[Required]
    public string $permission;

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
     */
    public static function with(string $permission, string $targetID): self
    {
        $self = new self;

        $self['permission'] = $permission;
        $self['targetID'] = $targetID;

        return $self;
    }

    /**
     * One of: pull, push, admin, maintain, triage.
     */
    public function withPermission(string $permission): self
    {
        $self = clone $this;
        $self['permission'] = $permission;

        return $self;
    }

    public function withTargetID(string $targetID): self
    {
        $self = clone $this;
        $self['targetID'] = $targetID;

        return $self;
    }
}
