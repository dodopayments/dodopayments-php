<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * License-key delivery payload, present on grants for `license_key`
 * entitlements. The grant's top-level `status` is the source of truth
 * for the grant's lifecycle.
 *
 * @phpstan-type LicenseKeyGrantShape = array{
 *   activationsUsed: int,
 *   key: string,
 *   activationsLimit?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class LicenseKeyGrant implements BaseModel
{
    /** @use SdkModel<LicenseKeyGrantShape> */
    use SdkModel;

    /**
     * Number of activations consumed so far.
     */
    #[Required('activations_used')]
    public int $activationsUsed;

    /**
     * Issued license key.
     */
    #[Required]
    public string $key;

    /**
     * Maximum activations allowed by the entitlement, when set.
     */
    #[Optional('activations_limit', nullable: true)]
    public ?int $activationsLimit;

    /**
     * When the license key expires, when applicable.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * `new LicenseKeyGrant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKeyGrant::with(activationsUsed: ..., key: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKeyGrant)->withActivationsUsed(...)->withKey(...)
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
    public static function with(
        int $activationsUsed,
        string $key,
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
    ): self {
        $self = new self;

        $self['activationsUsed'] = $activationsUsed;
        $self['key'] = $key;

        null !== $activationsLimit && $self['activationsLimit'] = $activationsLimit;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Number of activations consumed so far.
     */
    public function withActivationsUsed(int $activationsUsed): self
    {
        $self = clone $this;
        $self['activationsUsed'] = $activationsUsed;

        return $self;
    }

    /**
     * Issued license key.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * Maximum activations allowed by the entitlement, when set.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $self = clone $this;
        $self['activationsLimit'] = $activationsLimit;

        return $self;
    }

    /**
     * When the license key expires, when applicable.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
