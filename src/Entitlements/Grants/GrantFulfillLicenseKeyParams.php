<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * For entitlements whose license-key config uses `manual` fulfillment, grants
 * are created in the `pending` state without a key. Call this endpoint to
 * deliver the key: the grant moves to `delivered`, the customer is emailed the
 * key, and the `license_key.created` and `entitlement_grant.delivered` webhook
 * events are sent.
 *
 * @see Dodopayments\Services\Entitlements\GrantsService::fulfillLicenseKey()
 *
 * @phpstan-type GrantFulfillLicenseKeyParamsShape = array{
 *   key: string, activationsLimit?: int|null, expiresAt?: \DateTimeInterface|null
 * }
 */
final class GrantFulfillLicenseKeyParams implements BaseModel
{
    /** @use SdkModel<GrantFulfillLicenseKeyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The license key value to deliver to the customer.
     */
    #[Required]
    public string $key;

    /**
     * Per-key activation limit. Defaults to the entitlement's license-key configuration.
     */
    #[Optional('activations_limit', nullable: true)]
    public ?int $activationsLimit;

    /**
     * When the key expires. Defaults to the duration in the entitlement's license-key configuration.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * `new GrantFulfillLicenseKeyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GrantFulfillLicenseKeyParams::with(key: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GrantFulfillLicenseKeyParams)->withKey(...)
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
        string $key,
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
    ): self {
        $self = new self;

        $self['key'] = $key;

        null !== $activationsLimit && $self['activationsLimit'] = $activationsLimit;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The license key value to deliver to the customer.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * Per-key activation limit. Defaults to the entitlement's license-key configuration.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $self = clone $this;
        $self['activationsLimit'] = $activationsLimit;

        return $self;
    }

    /**
     * When the key expires. Defaults to the duration in the entitlement's license-key configuration.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
