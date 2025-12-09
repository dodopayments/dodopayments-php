<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type LicenseKeyShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   instancesCount: int,
 *   key: string,
 *   paymentID: string,
 *   productID: string,
 *   status: value-of<LicenseKeyStatus>,
 *   activationsLimit?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   subscriptionID?: string|null,
 * }
 */
final class LicenseKey implements BaseModel
{
    /** @use SdkModel<LicenseKeyShape> */
    use SdkModel;

    /**
     * The unique identifier of the license key.
     */
    #[Required]
    public string $id;

    /**
     * The unique identifier of the business associated with the license key.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The unique identifier of the customer associated with the license key.
     */
    #[Required('customer_id')]
    public string $customerID;

    /**
     * The current number of instances activated for this license key.
     */
    #[Required('instances_count')]
    public int $instancesCount;

    /**
     * The license key string.
     */
    #[Required]
    public string $key;

    /**
     * The unique identifier of the payment associated with the license key.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * The unique identifier of the product associated with the license key.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * The current status of the license key (e.g., active, inactive, expired).
     *
     * @var value-of<LicenseKeyStatus> $status
     */
    #[Required(enum: LicenseKeyStatus::class)]
    public string $status;

    /**
     * The maximum number of activations allowed for this license key.
     */
    #[Optional('activations_limit', nullable: true)]
    public ?int $activationsLimit;

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    #[Optional('subscription_id', nullable: true)]
    public ?string $subscriptionID;

    /**
     * `new LicenseKey()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKey::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   customerID: ...,
     *   instancesCount: ...,
     *   key: ...,
     *   paymentID: ...,
     *   productID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKey)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomerID(...)
     *   ->withInstancesCount(...)
     *   ->withKey(...)
     *   ->withPaymentID(...)
     *   ->withProductID(...)
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
        string $businessID,
        \DateTimeInterface $createdAt,
        string $customerID,
        int $instancesCount,
        string $key,
        string $paymentID,
        string $productID,
        LicenseKeyStatus|string $status,
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $subscriptionID = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['businessID'] = $businessID;
        $obj['createdAt'] = $createdAt;
        $obj['customerID'] = $customerID;
        $obj['instancesCount'] = $instancesCount;
        $obj['key'] = $key;
        $obj['paymentID'] = $paymentID;
        $obj['productID'] = $productID;
        $obj['status'] = $status;

        null !== $activationsLimit && $obj['activationsLimit'] = $activationsLimit;
        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;
        null !== $subscriptionID && $obj['subscriptionID'] = $subscriptionID;

        return $obj;
    }

    /**
     * The unique identifier of the license key.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * The unique identifier of the business associated with the license key.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['businessID'] = $businessID;

        return $obj;
    }

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * The unique identifier of the customer associated with the license key.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customerID'] = $customerID;

        return $obj;
    }

    /**
     * The current number of instances activated for this license key.
     */
    public function withInstancesCount(int $instancesCount): self
    {
        $obj = clone $this;
        $obj['instancesCount'] = $instancesCount;

        return $obj;
    }

    /**
     * The license key string.
     */
    public function withKey(string $key): self
    {
        $obj = clone $this;
        $obj['key'] = $key;

        return $obj;
    }

    /**
     * The unique identifier of the payment associated with the license key.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['paymentID'] = $paymentID;

        return $obj;
    }

    /**
     * The unique identifier of the product associated with the license key.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['productID'] = $productID;

        return $obj;
    }

    /**
     * The current status of the license key (e.g., active, inactive, expired).
     *
     * @param LicenseKeyStatus|value-of<LicenseKeyStatus> $status
     */
    public function withStatus(LicenseKeyStatus|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * The maximum number of activations allowed for this license key.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $obj = clone $this;
        $obj['activationsLimit'] = $activationsLimit;

        return $obj;
    }

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj['expiresAt'] = $expiresAt;

        return $obj;
    }

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    public function withSubscriptionID(?string $subscriptionID): self
    {
        $obj = clone $this;
        $obj['subscriptionID'] = $subscriptionID;

        return $obj;
    }
}
