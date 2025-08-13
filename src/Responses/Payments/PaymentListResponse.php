<?php

declare(strict_types=1);

namespace DodopaymentsClient\Responses\Payments;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\MapOf;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Payments\CustomerLimitedDetails;
use DodopaymentsClient\Payments\IntentStatus;

/**
 * @phpstan-type payment_list_response_alias = array{
 *   brandID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency::*,
 *   customer: CustomerLimitedDetails,
 *   digitalProductsDelivered: bool,
 *   metadata: array<string, string>,
 *   paymentID: string,
 *   totalAmount: int,
 *   paymentMethod?: string|null,
 *   paymentMethodType?: string|null,
 *   status?: IntentStatus::*,
 *   subscriptionID?: string|null,
 * }
 */
final class PaymentListResponse implements BaseModel
{
    use Model;

    #[Api('brand_id')]
    public string $brandID;

    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var Currency::* $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api]
    public CustomerLimitedDetails $customer;

    #[Api('digital_products_delivered')]
    public bool $digitalProductsDelivered;

    /** @var array<string, string> $metadata */
    #[Api(type: new MapOf('string'))]
    public array $metadata;

    #[Api('payment_id')]
    public string $paymentID;

    #[Api('total_amount')]
    public int $totalAmount;

    #[Api('payment_method', optional: true)]
    public ?string $paymentMethod;

    #[Api('payment_method_type', optional: true)]
    public ?string $paymentMethodType;

    /** @var null|IntentStatus::* $status */
    #[Api(enum: IntentStatus::class, optional: true)]
    public ?string $status;

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
     * @param Currency::* $currency
     * @param array<string, string> $metadata
     * @param IntentStatus::* $status
     */
    public static function from(
        string $brandID,
        \DateTimeInterface $createdAt,
        string $currency,
        CustomerLimitedDetails $customer,
        bool $digitalProductsDelivered,
        array $metadata,
        string $paymentID,
        int $totalAmount,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        ?string $status = null,
        ?string $subscriptionID = null,
    ): self {
        $obj = new self;

        $obj->brandID = $brandID;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency;
        $obj->customer = $customer;
        $obj->digitalProductsDelivered = $digitalProductsDelivered;
        $obj->metadata = $metadata;
        $obj->paymentID = $paymentID;
        $obj->totalAmount = $totalAmount;

        null !== $paymentMethod && $obj->paymentMethod = $paymentMethod;
        null !== $paymentMethodType && $obj->paymentMethodType = $paymentMethodType;
        null !== $status && $obj->status = $status;
        null !== $subscriptionID && $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    public function setBrandID(string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param Currency::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function setCustomer(CustomerLimitedDetails $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function setDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $this->digitalProductsDelivered = $digitalProductsDelivered;

        return $this;
    }

    /**
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    public function setTotalAmount(int $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function setPaymentMethodType(?string $paymentMethodType): self
    {
        $this->paymentMethodType = $paymentMethodType;

        return $this;
    }

    /**
     * @param IntentStatus::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setSubscriptionID(?string $subscriptionID): self
    {
        $this->subscriptionID = $subscriptionID;

        return $this;
    }
}
