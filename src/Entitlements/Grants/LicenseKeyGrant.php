<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\LicenseKeys\LicenseKeyStatus;

/**
 * License-key delivery payload, present on grants for `license_key`
 * entitlements. The grant's top-level `status` is the source of truth
 * for the grant's lifecycle.
 *
 * @phpstan-type LicenseKeyGrantShape = array{
 *   id: string,
 *   activationsUsed: int,
 *   key: string,
 *   status: LicenseKeyStatus|value-of<LicenseKeyStatus>,
 *   activationsLimit?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class LicenseKeyGrant implements BaseModel
{
    /** @use SdkModel<LicenseKeyGrantShape> */
    use SdkModel;

    /**
     * Identifier of the issued license key.
     */
    #[Required]
    public string $id;

    /**
     * Number of instances currently active. Activation increments it and
     * deactivation decrements it, so it is a live count and not a total.
     */
    #[Required('activations_used')]
    public int $activationsUsed;

    /**
     * Issued license key.
     */
    #[Required]
    public string $key;

    /**
     * Current status of the license key. Activation fails unless it is
     * `active`, so a client can warn before the customer tries.
     *
     * @var value-of<LicenseKeyStatus> $status
     */
    #[Required(enum: LicenseKeyStatus::class)]
    public string $status;

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
     * LicenseKeyGrant::with(id: ..., activationsUsed: ..., key: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKeyGrant)
     *   ->withID(...)
     *   ->withActivationsUsed(...)
     *   ->withKey(...)
     *   ->withStatus(...)
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
     * @param LicenseKeyStatus|value-of<LicenseKeyStatus> $status
     */
    public static function with(
        string $id,
        int $activationsUsed,
        string $key,
        LicenseKeyStatus|string $status,
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['activationsUsed'] = $activationsUsed;
        $self['key'] = $key;
        $self['status'] = $status;

        null !== $activationsLimit && $self['activationsLimit'] = $activationsLimit;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Identifier of the issued license key.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of instances currently active. Activation increments it and
     * deactivation decrements it, so it is a live count and not a total.
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
     * Current status of the license key. Activation fails unless it is
     * `active`, so a client can warn before the customer tries.
     *
     * @param LicenseKeyStatus|value-of<LicenseKeyStatus> $status
     */
    public function withStatus(LicenseKeyStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

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
