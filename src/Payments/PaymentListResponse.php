<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-import-type CustomerLimitedDetailsShape from \Dodopayments\Payments\CustomerLimitedDetails
 *
 * @phpstan-type PaymentListResponseShape = array{
 *   brandID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   customer: CustomerLimitedDetails|CustomerLimitedDetailsShape,
 *   digitalProductsDelivered: bool,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   totalAmount: int,
 *   paymentMethod?: string|null,
 *   paymentMethodType?: string|null,
 *   status?: null|IntentStatus|value-of<IntentStatus>,
 *   subscriptionID?: string|null,
 * }
 */
final class PaymentListResponse implements BaseModel
{
    /** @use SdkModel<PaymentListResponseShape> */
    use SdkModel;

    #[Required('brand_id')]
    public string $brandID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public CustomerLimitedDetails $customer;

    #[Required('digital_products_delivered')]
    public bool $digitalProductsDelivered;

    /** @var array<string,string> $metadata */
    #[Required(map: 'string')]
    public array $metadata;

    #[Required('payment_id')]
    public string $paymentID;

    #[Required('total_amount')]
    public int $totalAmount;

    #[Optional('payment_method', nullable: true)]
    public ?string $paymentMethod;

    #[Optional('payment_method_type', nullable: true)]
    public ?string $paymentMethodType;

    /** @var value-of<IntentStatus>|null $status */
    #[Optional(enum: IntentStatus::class, nullable: true)]
    public ?string $status;

    #[Optional('subscription_id', nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency|value-of<Currency> $currency
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
     * @param array<string,string> $metadata
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public static function with(
        string $brandID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        CustomerLimitedDetails|array $customer,
        bool $digitalProductsDelivered,
        array $metadata,
        string $paymentID,
        int $totalAmount,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        IntentStatus|string|null $status = null,
        ?string $subscriptionID = null,
    ): self {
        $self = new self;

        $self['brandID'] = $brandID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customer'] = $customer;
        $self['digitalProductsDelivered'] = $digitalProductsDelivered;
        $self['metadata'] = $metadata;
        $self['paymentID'] = $paymentID;
        $self['totalAmount'] = $totalAmount;

        null !== $paymentMethod && $self['paymentMethod'] = $paymentMethod;
        null !== $paymentMethodType && $self['paymentMethodType'] = $paymentMethodType;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $self = clone $this;
        $self['digitalProductsDelivered'] = $digitalProductsDelivered;

        return $self;
    }

    /**
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    public function withPaymentMethod(?string $paymentMethod): self
    {
        $self = clone $this;
        $self['paymentMethod'] = $paymentMethod;

        return $self;
    }

    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $self = clone $this;
        $self['paymentMethodType'] = $paymentMethodType;

        return $self;
    }

    /**
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public function withStatus(IntentStatus|string|null $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withSubscriptionID(?string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
