<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\PaymentProcessingWebhookEvent;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\Dispute;
use Dodopayments\Disputes\DisputeStage;
use Dodopayments\Disputes\DisputeStatus;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Payments\IntentStatus;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Payments\Payment\Refund;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\Webhooks\PaymentProcessingWebhookEvent\Data\PayloadType;

/**
 * Event-specific data.
 *
 * @phpstan-type DataShape = array{
 *   billing: BillingAddress,
 *   brandID: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer: CustomerLimitedDetails,
 *   digitalProductsDelivered: bool,
 *   disputes: list<Dispute>,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   refunds: list<Refund>,
 *   settlementAmount: int,
 *   settlementCurrency: value-of<Currency>,
 *   totalAmount: int,
 *   cardIssuingCountry?: value-of<CountryCode>|null,
 *   cardLastFour?: string|null,
 *   cardNetwork?: string|null,
 *   cardType?: string|null,
 *   checkoutSessionID?: string|null,
 *   discountID?: string|null,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   paymentLink?: string|null,
 *   paymentMethod?: string|null,
 *   paymentMethodType?: string|null,
 *   productCart?: list<ProductCart>|null,
 *   settlementTax?: int|null,
 *   status?: value-of<IntentStatus>|null,
 *   subscriptionID?: string|null,
 *   tax?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   payloadType?: value-of<PayloadType>|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public BillingAddress $billing;

    /**
     * brand id this payment belongs to.
     */
    #[Required('brand_id')]
    public string $brandID;

    /**
     * Identifier of the business associated with the payment.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Timestamp when the payment was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * brand id this payment belongs to.
     */
    #[Required('digital_products_delivered')]
    public bool $digitalProductsDelivered;

    /**
     * List of disputes associated with this payment.
     *
     * @var list<Dispute> $disputes
     */
    #[Required(list: Dispute::class)]
    public array $disputes;

    /**
     * Additional custom data associated with the payment.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Unique identifier for the payment.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * List of refunds issued for this payment.
     *
     * @var list<Refund> $refunds
     */
    #[Required(list: Refund::class)]
    public array $refunds;

    /**
     * The amount that will be credited to your Dodo balance after currency conversion and processing.
     * Especially relevant for adaptive pricing where the customer's payment currency differs from your settlement currency.
     */
    #[Required('settlement_amount')]
    public int $settlementAmount;

    /** @var value-of<Currency> $settlementCurrency */
    #[Required('settlement_currency', enum: Currency::class)]
    public string $settlementCurrency;

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    #[Required('total_amount')]
    public int $totalAmount;

    /**
     * ISO country code alpha2 variant.
     *
     * @var value-of<CountryCode>|null $cardIssuingCountry
     */
    #[Optional('card_issuing_country', enum: CountryCode::class)]
    public ?string $cardIssuingCountry;

    /**
     * The last four digits of the card.
     */
    #[Optional('card_last_four', nullable: true)]
    public ?string $cardLastFour;

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    #[Optional('card_network', nullable: true)]
    public ?string $cardNetwork;

    /**
     * The type of card DEBIT or CREDIT.
     */
    #[Optional('card_type', nullable: true)]
    public ?string $cardType;

    /**
     * If payment is made using a checkout session,
     * this field is set to the id of the session.
     */
    #[Optional('checkout_session_id', nullable: true)]
    public ?string $checkoutSessionID;

    /**
     * The discount id if discount is applied.
     */
    #[Optional('discount_id', nullable: true)]
    public ?string $discountID;

    /**
     * An error code if the payment failed.
     */
    #[Optional('error_code', nullable: true)]
    public ?string $errorCode;

    /**
     * An error message if the payment failed.
     */
    #[Optional('error_message', nullable: true)]
    public ?string $errorMessage;

    /**
     * Checkout URL.
     */
    #[Optional('payment_link', nullable: true)]
    public ?string $paymentLink;

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    #[Optional('payment_method', nullable: true)]
    public ?string $paymentMethod;

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    #[Optional('payment_method_type', nullable: true)]
    public ?string $paymentMethodType;

    /**
     * List of products purchased in a one-time payment.
     *
     * @var list<ProductCart>|null $productCart
     */
    #[Optional('product_cart', list: ProductCart::class, nullable: true)]
    public ?array $productCart;

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    #[Optional('settlement_tax', nullable: true)]
    public ?int $settlementTax;

    /** @var value-of<IntentStatus>|null $status */
    #[Optional(enum: IntentStatus::class)]
    public ?string $status;

    /**
     * Identifier of the subscription if payment is part of a subscription.
     */
    #[Optional('subscription_id', nullable: true)]
    public ?string $subscriptionID;

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * Timestamp when the payment was last updated.
     */
    #[Optional('updated_at', nullable: true)]
    public ?\DateTimeInterface $updatedAt;

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
     *   billing: ...,
     *   brandID: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customer: ...,
     *   digitalProductsDelivered: ...,
     *   disputes: ...,
     *   metadata: ...,
     *   paymentID: ...,
     *   refunds: ...,
     *   settlementAmount: ...,
     *   settlementCurrency: ...,
     *   totalAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withBilling(...)
     *   ->withBrandID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withDigitalProductsDelivered(...)
     *   ->withDisputes(...)
     *   ->withMetadata(...)
     *   ->withPaymentID(...)
     *   ->withRefunds(...)
     *   ->withSettlementAmount(...)
     *   ->withSettlementCurrency(...)
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
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * } $billing
     * @param Currency|value-of<Currency> $currency
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     * @param list<Dispute|array{
     *   amount: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: string,
     *   disputeID: string,
     *   disputeStage: value-of<DisputeStage>,
     *   disputeStatus: value-of<DisputeStatus>,
     *   paymentID: string,
     *   remarks?: string|null,
     * }> $disputes
     * @param array<string,string> $metadata
     * @param list<Refund|array{
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   isPartial: bool,
     *   paymentID: string,
     *   refundID: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     * }> $refunds
     * @param Currency|value-of<Currency> $settlementCurrency
     * @param CountryCode|value-of<CountryCode> $cardIssuingCountry
     * @param list<ProductCart|array{
     *   productID: string, quantity: int
     * }>|null $productCart
     * @param IntentStatus|value-of<IntentStatus> $status
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public static function with(
        BillingAddress|array $billing,
        string $brandID,
        string $businessID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        CustomerLimitedDetails|array $customer,
        bool $digitalProductsDelivered,
        array $disputes,
        array $metadata,
        string $paymentID,
        array $refunds,
        int $settlementAmount,
        Currency|string $settlementCurrency,
        int $totalAmount,
        CountryCode|string|null $cardIssuingCountry = null,
        ?string $cardLastFour = null,
        ?string $cardNetwork = null,
        ?string $cardType = null,
        ?string $checkoutSessionID = null,
        ?string $discountID = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?string $paymentLink = null,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        ?array $productCart = null,
        ?int $settlementTax = null,
        IntentStatus|string|null $status = null,
        ?string $subscriptionID = null,
        ?int $tax = null,
        ?\DateTimeInterface $updatedAt = null,
        PayloadType|string|null $payloadType = null,
    ): self {
        $self = new self;

        $self['billing'] = $billing;
        $self['brandID'] = $brandID;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customer'] = $customer;
        $self['digitalProductsDelivered'] = $digitalProductsDelivered;
        $self['disputes'] = $disputes;
        $self['metadata'] = $metadata;
        $self['paymentID'] = $paymentID;
        $self['refunds'] = $refunds;
        $self['settlementAmount'] = $settlementAmount;
        $self['settlementCurrency'] = $settlementCurrency;
        $self['totalAmount'] = $totalAmount;

        null !== $cardIssuingCountry && $self['cardIssuingCountry'] = $cardIssuingCountry;
        null !== $cardLastFour && $self['cardLastFour'] = $cardLastFour;
        null !== $cardNetwork && $self['cardNetwork'] = $cardNetwork;
        null !== $cardType && $self['cardType'] = $cardType;
        null !== $checkoutSessionID && $self['checkoutSessionID'] = $checkoutSessionID;
        null !== $discountID && $self['discountID'] = $discountID;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;
        null !== $paymentMethod && $self['paymentMethod'] = $paymentMethod;
        null !== $paymentMethodType && $self['paymentMethodType'] = $paymentMethodType;
        null !== $productCart && $self['productCart'] = $productCart;
        null !== $settlementTax && $self['settlementTax'] = $settlementTax;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;
        null !== $tax && $self['tax'] = $tax;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $payloadType && $self['payloadType'] = $payloadType;

        return $self;
    }

    /**
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * } $billing
     */
    public function withBilling(BillingAddress|array $billing): self
    {
        $self = clone $this;
        $self['billing'] = $billing;

        return $self;
    }

    /**
     * brand id this payment belongs to.
     */
    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Identifier of the business associated with the payment.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Timestamp when the payment was created.
     */
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
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * brand id this payment belongs to.
     */
    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $self = clone $this;
        $self['digitalProductsDelivered'] = $digitalProductsDelivered;

        return $self;
    }

    /**
     * List of disputes associated with this payment.
     *
     * @param list<Dispute|array{
     *   amount: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: string,
     *   disputeID: string,
     *   disputeStage: value-of<DisputeStage>,
     *   disputeStatus: value-of<DisputeStatus>,
     *   paymentID: string,
     *   remarks?: string|null,
     * }> $disputes
     */
    public function withDisputes(array $disputes): self
    {
        $self = clone $this;
        $self['disputes'] = $disputes;

        return $self;
    }

    /**
     * Additional custom data associated with the payment.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Unique identifier for the payment.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * List of refunds issued for this payment.
     *
     * @param list<Refund|array{
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   isPartial: bool,
     *   paymentID: string,
     *   refundID: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     * }> $refunds
     */
    public function withRefunds(array $refunds): self
    {
        $self = clone $this;
        $self['refunds'] = $refunds;

        return $self;
    }

    /**
     * The amount that will be credited to your Dodo balance after currency conversion and processing.
     * Especially relevant for adaptive pricing where the customer's payment currency differs from your settlement currency.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $self = clone $this;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $settlementCurrency
     */
    public function withSettlementCurrency(
        Currency|string $settlementCurrency
    ): self {
        $self = clone $this;
        $self['settlementCurrency'] = $settlementCurrency;

        return $self;
    }

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    /**
     * ISO country code alpha2 variant.
     *
     * @param CountryCode|value-of<CountryCode> $cardIssuingCountry
     */
    public function withCardIssuingCountry(
        CountryCode|string $cardIssuingCountry
    ): self {
        $self = clone $this;
        $self['cardIssuingCountry'] = $cardIssuingCountry;

        return $self;
    }

    /**
     * The last four digits of the card.
     */
    public function withCardLastFour(?string $cardLastFour): self
    {
        $self = clone $this;
        $self['cardLastFour'] = $cardLastFour;

        return $self;
    }

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    public function withCardNetwork(?string $cardNetwork): self
    {
        $self = clone $this;
        $self['cardNetwork'] = $cardNetwork;

        return $self;
    }

    /**
     * The type of card DEBIT or CREDIT.
     */
    public function withCardType(?string $cardType): self
    {
        $self = clone $this;
        $self['cardType'] = $cardType;

        return $self;
    }

    /**
     * If payment is made using a checkout session,
     * this field is set to the id of the session.
     */
    public function withCheckoutSessionID(?string $checkoutSessionID): self
    {
        $self = clone $this;
        $self['checkoutSessionID'] = $checkoutSessionID;

        return $self;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $self = clone $this;
        $self['discountID'] = $discountID;

        return $self;
    }

    /**
     * An error code if the payment failed.
     */
    public function withErrorCode(?string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * An error message if the payment failed.
     */
    public function withErrorMessage(?string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }

    /**
     * Checkout URL.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $self = clone $this;
        $self['paymentLink'] = $paymentLink;

        return $self;
    }

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    public function withPaymentMethod(?string $paymentMethod): self
    {
        $self = clone $this;
        $self['paymentMethod'] = $paymentMethod;

        return $self;
    }

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $self = clone $this;
        $self['paymentMethodType'] = $paymentMethodType;

        return $self;
    }

    /**
     * List of products purchased in a one-time payment.
     *
     * @param list<ProductCart|array{
     *   productID: string, quantity: int
     * }>|null $productCart
     */
    public function withProductCart(?array $productCart): self
    {
        $self = clone $this;
        $self['productCart'] = $productCart;

        return $self;
    }

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    public function withSettlementTax(?int $settlementTax): self
    {
        $self = clone $this;
        $self['settlementTax'] = $settlementTax;

        return $self;
    }

    /**
     * @param IntentStatus|value-of<IntentStatus> $status
     */
    public function withStatus(IntentStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Identifier of the subscription if payment is part of a subscription.
     */
    public function withSubscriptionID(?string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    public function withTax(?int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * Timestamp when the payment was last updated.
     */
    public function withUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

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
