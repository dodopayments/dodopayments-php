<?php

declare(strict_types=1);

namespace DodoPayments\LicenseKeys;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type license_key_alias = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   instancesCount: int,
 *   key: string,
 *   paymentID: string,
 *   productID: string,
 *   status: LicenseKeyStatus::*,
 *   activationsLimit?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   subscriptionID?: string|null,
 * }
 */
final class LicenseKey implements BaseModel
{
    use Model;

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

    /**
     * The current status of the license key (e.g., active, inactive, expired).
     *
     * @var LicenseKeyStatus::* $status
     */
    #[Api(enum: LicenseKeyStatus::class)]
    public string $status;

    /**
     * The maximum number of activations allowed for this license key.
     */
    #[Api('activations_limit', optional: true)]
    public ?int $activationsLimit;

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    #[Api('expires_at', optional: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    #[Api('subscription_id', optional: true)]
    public ?string $subscriptionID;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param LicenseKeyStatus::* $status
     */
    public static function from(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $customerID,
        int $instancesCount,
        string $key,
        string $paymentID,
        string $productID,
        string $status,
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
        $obj->status = $status;

        null !== $activationsLimit && $obj->activationsLimit = $activationsLimit;
        null !== $expiresAt && $obj->expiresAt = $expiresAt;
        null !== $subscriptionID && $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    /**
     * The unique identifier of the license key.
     */
    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * The unique identifier of the business associated with the license key.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * The unique identifier of the customer associated with the license key.
     */
    public function setCustomerID(string $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }

    /**
     * The current number of instances activated for this license key.
     */
    public function setInstancesCount(int $instancesCount): self
    {
        $this->instancesCount = $instancesCount;

        return $this;
    }

    /**
     * The license key string.
     */
    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * The unique identifier of the payment associated with the license key.
     */
    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    /**
     * The unique identifier of the product associated with the license key.
     */
    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * The current status of the license key (e.g., active, inactive, expired).
     *
     * @param LicenseKeyStatus::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * The maximum number of activations allowed for this license key.
     */
    public function setActivationsLimit(?int $activationsLimit): self
    {
        $this->activationsLimit = $activationsLimit;

        return $this;
    }

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    public function setSubscriptionID(?string $subscriptionID): self
    {
        $this->subscriptionID = $subscriptionID;

        return $this;
    }
}
