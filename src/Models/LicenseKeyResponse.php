<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class LicenseKeyResponse
{
    /**
     * The maximum number of activations allowed for this license key.
     */
    #[SerializedName('activations_limit')]
    public ?int $activationsLimit;

    /**
     * The unique identifier of the business associated with the license key.
     */
    #[SerializedName('business_id')]
    public string $businessId;

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    #[SerializedName('created_at')]
    public string $createdAt;

    /**
     * The unique identifier of the customer associated with the license key.
     */
    #[SerializedName('customer_id')]
    public string $customerId;

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    #[SerializedName('expires_at')]
    public ?string $expiresAt;

    /**
     * The unique identifier of the license key.
     */
    #[SerializedName('id')]
    public string $id;

    /**
     * The current number of instances activated for this license key.
     */
    #[SerializedName('instances_count')]
    public int $instancesCount;

    /**
     * The license key string.
     */
    #[SerializedName('key')]
    public string $key;

    /**
     * The unique identifier of the payment associated with the license key.
     */
    #[SerializedName('payment_id')]
    public string $paymentId;

    /**
     * The unique identifier of the product associated with the license key.
     */
    #[SerializedName('product_id')]
    public string $productId;

    #[SerializedName('status')]
    public LicenseKeyStatus $status;

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    #[SerializedName('subscription_id')]
    public ?string $subscriptionId;

    public function __construct(
        ?int $activationsLimit = null,
        string $businessId,
        string $createdAt,
        string $customerId,
        ?string $expiresAt = null,
        string $id,
        int $instancesCount,
        string $key,
        string $paymentId,
        string $productId,
        LicenseKeyStatus $status,
        ?string $subscriptionId = null
    ) {
        $this->activationsLimit = $activationsLimit;
        $this->businessId = $businessId;
        $this->createdAt = $createdAt;
        $this->customerId = $customerId;
        $this->expiresAt = $expiresAt;
        $this->id = $id;
        $this->instancesCount = $instancesCount;
        $this->key = $key;
        $this->paymentId = $paymentId;
        $this->productId = $productId;
        $this->status = $status;
        $this->subscriptionId = $subscriptionId;
    }
}
