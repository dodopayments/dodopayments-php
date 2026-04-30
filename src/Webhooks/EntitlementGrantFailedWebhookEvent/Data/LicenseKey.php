<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\EntitlementGrantFailedWebhookEvent\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Present only when the entitlement integration_type is `license_key`.
 *
 * @phpstan-type LicenseKeyShape = array{
 *   activationsUsed: int,
 *   key: string,
 *   activationsLimit?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class LicenseKey implements BaseModel
{
    /** @use SdkModel<LicenseKeyShape> */
    use SdkModel;

    #[Required('activations_used')]
    public int $activationsUsed;

    #[Required]
    public string $key;

    #[Optional('activations_limit', nullable: true)]
    public ?int $activationsLimit;

    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * `new LicenseKey()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKey::with(activationsUsed: ..., key: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKey)->withActivationsUsed(...)->withKey(...)
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

    public function withActivationsUsed(int $activationsUsed): self
    {
        $self = clone $this;
        $self['activationsUsed'] = $activationsUsed;

        return $self;
    }

    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    public function withActivationsLimit(?int $activationsLimit): self
    {
        $self = clone $this;
        $self['activationsLimit'] = $activationsLimit;

        return $self;
    }

    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
