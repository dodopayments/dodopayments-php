<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\LicenseKeys\LicenseKeyStatus;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey\PayloadType;

/**
 * @phpstan-type license_key = array{
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
 *   payloadType: value-of<PayloadType>,
 * }
 */
final class LicenseKey implements BaseModel
{
    /** @use SdkModel<license_key> */
    use SdkModel;

    /**
     * The unique identifier of the license key.
     */
    #[Api]
    public string $id;

    /**
     * The unique identifier of the business associated with the license key.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The unique identifier of the customer associated with the license key.
     */
    #[Api('customer_id')]
    public string $customerID;

    /**
     * The current number of instances activated for this license key.
     */
    #[Api('instances_count')]
    public int $instancesCount;

    /**
     * The license key string.
     */
    #[Api]
    public string $key;

    /**
     * The unique identifier of the payment associated with the license key.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * The unique identifier of the product associated with the license key.
     */
    #[Api('product_id')]
    public string $productID;

    /** @var value-of<LicenseKeyStatus> $status */
    #[Api(enum: LicenseKeyStatus::class)]
    public string $status;

    /**
     * The maximum number of activations allowed for this license key.
     */
    #[Api('activations_limit', nullable: true, optional: true)]
    public ?int $activationsLimit;

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    #[Api('expires_at', nullable: true, optional: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    #[Api('subscription_id', nullable: true, optional: true)]
    public ?string $subscriptionID;

    /** @var value-of<PayloadType> $payloadType */
    #[Api('payload_type', enum: PayloadType::class)]
    public string $payloadType;

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
     *   payloadType: ...,
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
     *   ->withPayloadType(...)
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
     * @param PayloadType|value-of<PayloadType> $payloadType
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
        PayloadType|string $payloadType,
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $subscriptionID = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->customerID = $customerID;
        $obj->instancesCount = $instancesCount;
        $obj->key = $key;
        $obj->paymentID = $paymentID;
        $obj->productID = $productID;
        $obj->status = $status instanceof LicenseKeyStatus ? $status->value : $status;
        $obj->payloadType = $payloadType instanceof PayloadType ? $payloadType->value : $payloadType;

        null !== $activationsLimit && $obj->activationsLimit = $activationsLimit;
        null !== $expiresAt && $obj->expiresAt = $expiresAt;
        null !== $subscriptionID && $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    /**
     * The unique identifier of the license key.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * The unique identifier of the business associated with the license key.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * The unique identifier of the customer associated with the license key.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    /**
     * The current number of instances activated for this license key.
     */
    public function withInstancesCount(int $instancesCount): self
    {
        $obj = clone $this;
        $obj->instancesCount = $instancesCount;

        return $obj;
    }

    /**
     * The license key string.
     */
    public function withKey(string $key): self
    {
        $obj = clone $this;
        $obj->key = $key;

        return $obj;
    }

    /**
     * The unique identifier of the payment associated with the license key.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->paymentID = $paymentID;

        return $obj;
    }

    /**
     * The unique identifier of the product associated with the license key.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

        return $obj;
    }

    /**
     * @param LicenseKeyStatus|value-of<LicenseKeyStatus> $status
     */
    public function withStatus(LicenseKeyStatus|string $status): self
    {
        $obj = clone $this;
        $obj->status = $status instanceof LicenseKeyStatus ? $status->value : $status;

        return $obj;
    }

    /**
     * The maximum number of activations allowed for this license key.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $obj = clone $this;
        $obj->activationsLimit = $activationsLimit;

        return $obj;
    }

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj->expiresAt = $expiresAt;

        return $obj;
    }

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    public function withSubscriptionID(?string $subscriptionID): self
    {
        $obj = clone $this;
        $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $obj = clone $this;
        $obj->payloadType = $payloadType instanceof PayloadType ? $payloadType->value : $payloadType;

        return $obj;
    }
}
