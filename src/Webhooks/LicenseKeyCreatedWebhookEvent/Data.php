<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\LicenseKeyCreatedWebhookEvent;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\LicenseKeys\LicenseKeyStatus;
use Dodopayments\Webhooks\LicenseKeyCreatedWebhookEvent\Data\PayloadType;

/**
 * Event-specific data.
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   instancesCount: int,
 *   key: string,
 *   paymentID: string,
 *   productID: string,
 *   status: LicenseKeyStatus|value-of<LicenseKeyStatus>,
 *   activationsLimit?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   subscriptionID?: string|null,
 *   payloadType?: null|PayloadType|value-of<PayloadType>,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
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

    /** @var value-of<LicenseKeyStatus> $status */
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
     * The type of payload in the data field.
     *
     * @var value-of<PayloadType>|null $payloadType
     */
    #[Optional('payload_type', enum: PayloadType::class)]
    public ?string $payloadType;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
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
     * (new Data)
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
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $subscriptionID = null,
        PayloadType|string|null $payloadType = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['customerID'] = $customerID;
        $self['instancesCount'] = $instancesCount;
        $self['key'] = $key;
        $self['paymentID'] = $paymentID;
        $self['productID'] = $productID;
        $self['status'] = $status;

        null !== $activationsLimit && $self['activationsLimit'] = $activationsLimit;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;
        null !== $payloadType && $self['payloadType'] = $payloadType;

        return $self;
    }

    /**
     * The unique identifier of the license key.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The unique identifier of the business associated with the license key.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The timestamp indicating when the license key was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The unique identifier of the customer associated with the license key.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * The current number of instances activated for this license key.
     */
    public function withInstancesCount(int $instancesCount): self
    {
        $self = clone $this;
        $self['instancesCount'] = $instancesCount;

        return $self;
    }

    /**
     * The license key string.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * The unique identifier of the payment associated with the license key.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * The unique identifier of the product associated with the license key.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * @param LicenseKeyStatus|value-of<LicenseKeyStatus> $status
     */
    public function withStatus(LicenseKeyStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The maximum number of activations allowed for this license key.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $self = clone $this;
        $self['activationsLimit'] = $activationsLimit;

        return $self;
    }

    /**
     * The timestamp indicating when the license key expires, in UTC.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The unique identifier of the subscription associated with the license key, if any.
     */
    public function withSubscriptionID(?string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * The type of payload in the data field.
     *
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }
}
