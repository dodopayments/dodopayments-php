<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type payment_list_response = array{
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
 *   status?: IntentStatus::*|null,
 *   subscriptionID?: string|null,
 * }
 */
final class PaymentListResponse implements BaseModel
{
    /** @use SdkModel<payment_list_response> */
    use SdkModel;

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
    #[Api(map: 'string')]
    public array $metadata;

    #[Api('payment_id')]
    public string $paymentID;

    #[Api('total_amount')]
    public int $totalAmount;

    #[Api('payment_method', nullable: true, optional: true)]
    public ?string $paymentMethod;

    #[Api('payment_method_type', nullable: true, optional: true)]
    public ?string $paymentMethodType;

    /** @var IntentStatus::*|null $status */
    #[Api(enum: IntentStatus::class, nullable: true, optional: true)]
    public ?string $status;

    #[Api('subscription_id', nullable: true, optional: true)]
    public ?string $subscriptionID;

    /**
     * `new PaymentListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentListResponse::with(
     *   brandID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customer: ...,
     *   digitalProductsDelivered: ...,
     *   metadata: ...,
     *   paymentID: ...,
     *   totalAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentListResponse)
     *   ->withBrandID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withDigitalProductsDelivered(...)
     *   ->withMetadata(...)
     *   ->withPaymentID(...)
     *   ->withTotalAmount(...)
     * ```
     */
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
    public static function with(
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

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj->brandID = $brandID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * @param Currency::* $currency
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

        return $obj;
    }

    public function withCustomer(CustomerLimitedDetails $customer): self
    {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $obj = clone $this;
        $obj->digitalProductsDelivered = $digitalProductsDelivered;

        return $obj;
    }

    /**
     * @param array<string, string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->paymentID = $paymentID;

        return $obj;
    }

    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj->totalAmount = $totalAmount;

        return $obj;
    }

    public function withPaymentMethod(?string $paymentMethod): self
    {
        $obj = clone $this;
        $obj->paymentMethod = $paymentMethod;

        return $obj;
    }

    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $obj = clone $this;
        $obj->paymentMethodType = $paymentMethodType;

        return $obj;
    }

    /**
     * @param IntentStatus::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    public function withSubscriptionID(?string $subscriptionID): self
    {
        $obj = clone $this;
        $obj->subscriptionID = $subscriptionID;

        return $obj;
    }
}
