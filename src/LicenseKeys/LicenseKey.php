<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type LicenseKeyShape = array{
 *   id: string,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   customer_id: string,
 *   instances_count: int,
 *   key: string,
 *   payment_id: string,
 *   product_id: string,
 *   status: value-of<LicenseKeyStatus>,
 *   activations_limit?: int|null,
 *   expires_at?: \DateTimeInterface|null,
 *   subscription_id?: string|null,
 * }
 */
final class LicenseKey implements BaseModel, ResponseConverter
{
    /** @use SdkModel<LicenseKeyShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * The unique identifier of the license key.
     */
    #[Api]
    public string $id;

    /**
     * The unique identifier of the business associated with the license key.
     */
    #[Api]
    public string $business_id;

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * The unique identifier of the customer associated with the license key.
     */
    #[Api]
    public string $customer_id;

    /**
     * The current number of instances activated for this license key.
     */
    #[Api]
    public int $instances_count;

    /**
     * The license key string.
     */
    #[Api]
    public string $key;

    /**
     * The unique identifier of the payment associated with the license key.
     */
    #[Api]
    public string $payment_id;

    /**
     * The unique identifier of the product associated with the license key.
     */
    #[Api]
    public string $product_id;

    /**
     * The current status of the license key (e.g., active, inactive, expired).
     *
     * @var value-of<LicenseKeyStatus> $status
     */
    #[Api(enum: LicenseKeyStatus::class)]
    public string $status;

    /**
     * The maximum number of activations allowed for this license key.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $activations_limit;

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $expires_at;

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $subscription_id;

    /**
     * `new LicenseKey()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKey::with(
     *   id: ...,
     *   business_id: ...,
     *   created_at: ...,
     *   customer_id: ...,
     *   instances_count: ...,
     *   key: ...,
     *   payment_id: ...,
     *   product_id: ...,
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
        string $business_id,
        \DateTimeInterface $created_at,
        string $customer_id,
        int $instances_count,
        string $key,
        string $payment_id,
        string $product_id,
        LicenseKeyStatus|string $status,
        ?int $activations_limit = null,
        ?\DateTimeInterface $expires_at = null,
        ?string $subscription_id = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['customer_id'] = $customer_id;
        $obj['instances_count'] = $instances_count;
        $obj['key'] = $key;
        $obj['payment_id'] = $payment_id;
        $obj['product_id'] = $product_id;
        $obj['status'] = $status;

        null !== $activations_limit && $obj['activations_limit'] = $activations_limit;
        null !== $expires_at && $obj['expires_at'] = $expires_at;
        null !== $subscription_id && $obj['subscription_id'] = $subscription_id;

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
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * The unique identifier of the customer associated with the license key.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customer_id'] = $customerID;

        return $obj;
    }

    /**
     * The current number of instances activated for this license key.
     */
    public function withInstancesCount(int $instancesCount): self
    {
        $obj = clone $this;
        $obj['instances_count'] = $instancesCount;

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
        $obj['payment_id'] = $paymentID;

        return $obj;
    }

    /**
     * The unique identifier of the product associated with the license key.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['product_id'] = $productID;

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
        $obj['activations_limit'] = $activationsLimit;

        return $obj;
    }

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj['expires_at'] = $expiresAt;

        return $obj;
    }

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    public function withSubscriptionID(?string $subscriptionID): self
    {
        $obj = clone $this;
        $obj['subscription_id'] = $subscriptionID;

        return $obj;
    }
}
