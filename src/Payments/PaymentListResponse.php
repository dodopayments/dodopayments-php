<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type PaymentListResponseShape = array{
 *   brand_id: string,
 *   created_at: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer: CustomerLimitedDetails,
 *   digital_products_delivered: bool,
 *   metadata: array<string,string>,
 *   payment_id: string,
 *   total_amount: int,
 *   payment_method?: string|null,
 *   payment_method_type?: string|null,
 *   status?: value-of<IntentStatus>|null,
 *   subscription_id?: string|null,
 * }
 */
final class PaymentListResponse implements BaseModel
{
    /** @use SdkModel<PaymentListResponseShape> */
    use SdkModel;

    #[Required]
    public string $brand_id;

    #[Required]
    public \DateTimeInterface $created_at;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public CustomerLimitedDetails $customer;

    #[Required]
    public bool $digital_products_delivered;

    /** @var array<string,string> $metadata */
    #[Required(map: 'string')]
    public array $metadata;

    #[Required]
    public string $payment_id;

    #[Required]
    public int $total_amount;

    #[Optional(nullable: true)]
    public ?string $payment_method;

    #[Optional(nullable: true)]
    public ?string $payment_method_type;

    /** @var value-of<IntentStatus>|null $status */
    #[Optional(enum: IntentStatus::class, nullable: true)]
    public ?string $status;

    #[Optional(nullable: true)]
    public ?string $subscription_id;

    /**
     * `new PaymentListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentListResponse::with(
     *   brand_id: ...,
     *   created_at: ...,
     *   currency: ...,
     *   customer: ...,
     *   digital_products_delivered: ...,
     *   metadata: ...,
     *   payment_id: ...,
     *   total_amount: ...,
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency|value-of<Currency> $currency
     * @param CustomerLimitedDetails|array{
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     * @param array<string,string> $metadata
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public static function with(
        string $brand_id,
        \DateTimeInterface $created_at,
        Currency|string $currency,
        CustomerLimitedDetails|array $customer,
        bool $digital_products_delivered,
        array $metadata,
        string $payment_id,
        int $total_amount,
        ?string $payment_method = null,
        ?string $payment_method_type = null,
        IntentStatus|string|null $status = null,
        ?string $subscription_id = null,
    ): self {
        $obj = new self;

        $obj['brand_id'] = $brand_id;
        $obj['created_at'] = $created_at;
        $obj['currency'] = $currency;
        $obj['customer'] = $customer;
        $obj['digital_products_delivered'] = $digital_products_delivered;
        $obj['metadata'] = $metadata;
        $obj['payment_id'] = $payment_id;
        $obj['total_amount'] = $total_amount;

        null !== $payment_method && $obj['payment_method'] = $payment_method;
        null !== $payment_method_type && $obj['payment_method_type'] = $payment_method_type;
        null !== $status && $obj['status'] = $status;
        null !== $subscription_id && $obj['subscription_id'] = $subscription_id;

        return $obj;
    }

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * @param CustomerLimitedDetails|array{
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $obj = clone $this;
        $obj['digital_products_delivered'] = $digitalProductsDelivered;

        return $obj;
    }

    /**
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['payment_id'] = $paymentID;

        return $obj;
    }

    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj['total_amount'] = $totalAmount;

        return $obj;
    }

    public function withPaymentMethod(?string $paymentMethod): self
    {
        $obj = clone $this;
        $obj['payment_method'] = $paymentMethod;

        return $obj;
    }

    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $obj = clone $this;
        $obj['payment_method_type'] = $paymentMethodType;

        return $obj;
    }

    /**
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public function withStatus(IntentStatus|string|null $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    public function withSubscriptionID(?string $subscriptionID): self
    {
        $obj = clone $this;
        $obj['subscription_id'] = $subscriptionID;

        return $obj;
    }
}
