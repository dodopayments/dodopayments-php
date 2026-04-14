<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicenseKeysService::create()
 *
 * @phpstan-type LicenseKeyCreateParamsShape = array{
 *   customerID: string,
 *   key: string,
 *   productID: string,
 *   activationsLimit?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class LicenseKeyCreateParams implements BaseModel
{
    /** @use SdkModel<LicenseKeyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The customer this license key belongs to.
     */
    #[Required('customer_id')]
    public string $customerID;

    /**
     * The license key string to import.
     */
    #[Required]
    public string $key;

    /**
     * The product this license key is for.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Maximum number of activations allowed. Null means unlimited.
     */
    #[Optional('activations_limit', nullable: true)]
    public ?int $activationsLimit;

    /**
     * Expiration timestamp. Null means the key never expires.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * `new LicenseKeyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKeyCreateParams::with(customerID: ..., key: ..., productID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKeyCreateParams)
     *   ->withCustomerID(...)
     *   ->withKey(...)
     *   ->withProductID(...)
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
        string $customerID,
        string $key,
        string $productID,
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
    ): self {
        $self = new self;

        $self['customerID'] = $customerID;
        $self['key'] = $key;
        $self['productID'] = $productID;

        null !== $activationsLimit && $self['activationsLimit'] = $activationsLimit;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The customer this license key belongs to.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * The license key string to import.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * The product this license key is for.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Maximum number of activations allowed. Null means unlimited.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $self = clone $this;
        $self['activationsLimit'] = $activationsLimit;

        return $self;
    }

    /**
     * Expiration timestamp. Null means the key never expires.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
