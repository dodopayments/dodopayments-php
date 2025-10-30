<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\PaymentProcessingWebhookEvent;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\Dispute;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Payments\IntentStatus;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Payments\Payment\Refund;
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
 *   metadata: array<string, string>,
 *   paymentID: string,
 *   refunds: list<Refund>,
 *   settlementAmount: int,
 *   settlementCurrency: value-of<Currency>,
 *   totalAmount: int,
 *   cardIssuingCountry?: value-of<CountryCode>,
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
 *   status?: value-of<IntentStatus>,
 *   subscriptionID?: string|null,
 *   tax?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   payloadType?: value-of<PayloadType>,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Api]
    public BillingAddress $billing;

    /**
     * brand id this payment belongs to.
     */
    #[Api('brand_id')]
    public string $brandID;

    /**
     * Identifier of the business associated with the payment.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * Timestamp when the payment was created.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * brand id this payment belongs to.
     */
    #[Api('digital_products_delivered')]
    public bool $digitalProductsDelivered;

    /**
     * List of disputes associated with this payment.
     *
     * @var list<Dispute> $disputes
     */
    #[Api(list: Dispute::class)]
    public array $disputes;

    /**
     * Additional custom data associated with the payment.
     *
     * @var array<string, string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * Unique identifier for the payment.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * List of refunds issued for this payment.
     *
     * @var list<Refund> $refunds
     */
    #[Api(list: Refund::class)]
    public array $refunds;

    /**
     * The amount that will be credited to your Dodo balance after currency conversion and processing.
     * Especially relevant for adaptive pricing where the customer's payment currency differs from your settlement currency.
     */
    #[Api('settlement_amount')]
    public int $settlementAmount;

    /** @var value-of<Currency> $settlementCurrency */
    #[Api('settlement_currency', enum: Currency::class)]
    public string $settlementCurrency;

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    #[Api('total_amount')]
    public int $totalAmount;

    /**
     * ISO country code alpha2 variant.
     *
     * @var value-of<CountryCode>|null $cardIssuingCountry
     */
    #[Api('card_issuing_country', enum: CountryCode::class, optional: true)]
    public ?string $cardIssuingCountry;

    /**
     * The last four digits of the card.
     */
    #[Api('card_last_four', nullable: true, optional: true)]
    public ?string $cardLastFour;

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    #[Api('card_network', nullable: true, optional: true)]
    public ?string $cardNetwork;

    /**
     * The type of card DEBIT or CREDIT.
     */
    #[Api('card_type', nullable: true, optional: true)]
    public ?string $cardType;

    /**
     * If payment is made using a checkout session,
     * this field is set to the id of the session.
     */
    #[Api('checkout_session_id', nullable: true, optional: true)]
    public ?string $checkoutSessionID;

    /**
     * The discount id if discount is applied.
     */
    #[Api('discount_id', nullable: true, optional: true)]
    public ?string $discountID;

    /**
     * An error code if the payment failed.
     */
    #[Api('error_code', nullable: true, optional: true)]
    public ?string $errorCode;

    /**
     * An error message if the payment failed.
     */
    #[Api('error_message', nullable: true, optional: true)]
    public ?string $errorMessage;

    /**
     * Checkout URL.
     */
    #[Api('payment_link', nullable: true, optional: true)]
    public ?string $paymentLink;

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    #[Api('payment_method', nullable: true, optional: true)]
    public ?string $paymentMethod;

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    #[Api('payment_method_type', nullable: true, optional: true)]
    public ?string $paymentMethodType;

    /**
     * List of products purchased in a one-time payment.
     *
     * @var list<ProductCart>|null $productCart
     */
    #[Api(
        'product_cart',
        list: ProductCart::class,
        nullable: true,
        optional: true
    )]
    public ?array $productCart;

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    #[Api('settlement_tax', nullable: true, optional: true)]
    public ?int $settlementTax;

    /** @var value-of<IntentStatus>|null $status */
    #[Api(enum: IntentStatus::class, optional: true)]
    public ?string $status;

    /**
     * Identifier of the subscription if payment is part of a subscription.
     */
    #[Api('subscription_id', nullable: true, optional: true)]
    public ?string $subscriptionID;

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    #[Api(nullable: true, optional: true)]
    public ?int $tax;

    /**
     * Timestamp when the payment was last updated.
     */
    #[Api('updated_at', nullable: true, optional: true)]
    public ?\DateTimeInterface $updatedAt;

    /**
     * The type of payload in the data field.
     *
     * @var value-of<PayloadType>|null $payloadType
     */
    #[Api('payload_type', enum: PayloadType::class, optional: true)]
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
     * @param Currency|value-of<Currency> $currency
     * @param list<Dispute> $disputes
     * @param array<string, string> $metadata
     * @param list<Refund> $refunds
     * @param Currency|value-of<Currency> $settlementCurrency
     * @param CountryCode|value-of<CountryCode> $cardIssuingCountry
     * @param list<ProductCart>|null $productCart
     * @param IntentStatus|value-of<IntentStatus> $status
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public static function with(
        BillingAddress $billing,
        string $brandID,
        string $businessID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        CustomerLimitedDetails $customer,
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
        $obj = new self;

        $obj->billing = $billing;
        $obj->brandID = $brandID;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj['currency'] = $currency;
        $obj->customer = $customer;
        $obj->digitalProductsDelivered = $digitalProductsDelivered;
        $obj->disputes = $disputes;
        $obj->metadata = $metadata;
        $obj->paymentID = $paymentID;
        $obj->refunds = $refunds;
        $obj->settlementAmount = $settlementAmount;
        $obj['settlementCurrency'] = $settlementCurrency;
        $obj->totalAmount = $totalAmount;

        null !== $cardIssuingCountry && $obj['cardIssuingCountry'] = $cardIssuingCountry;
        null !== $cardLastFour && $obj->cardLastFour = $cardLastFour;
        null !== $cardNetwork && $obj->cardNetwork = $cardNetwork;
        null !== $cardType && $obj->cardType = $cardType;
        null !== $checkoutSessionID && $obj->checkoutSessionID = $checkoutSessionID;
        null !== $discountID && $obj->discountID = $discountID;
        null !== $errorCode && $obj->errorCode = $errorCode;
        null !== $errorMessage && $obj->errorMessage = $errorMessage;
        null !== $paymentLink && $obj->paymentLink = $paymentLink;
        null !== $paymentMethod && $obj->paymentMethod = $paymentMethod;
        null !== $paymentMethodType && $obj->paymentMethodType = $paymentMethodType;
        null !== $productCart && $obj->productCart = $productCart;
        null !== $settlementTax && $obj->settlementTax = $settlementTax;
        null !== $status && $obj['status'] = $status;
        null !== $subscriptionID && $obj->subscriptionID = $subscriptionID;
        null !== $tax && $obj->tax = $tax;
        null !== $updatedAt && $obj->updatedAt = $updatedAt;
        null !== $payloadType && $obj['payloadType'] = $payloadType;

        return $obj;
    }

    public function withBilling(BillingAddress $billing): self
    {
        $obj = clone $this;
        $obj->billing = $billing;

        return $obj;
    }

    /**
     * brand id this payment belongs to.
     */
    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj->brandID = $brandID;

        return $obj;
    }

    /**
     * Identifier of the business associated with the payment.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * Timestamp when the payment was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

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

    public function withCustomer(CustomerLimitedDetails $customer): self
    {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * brand id this payment belongs to.
     */
    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $obj = clone $this;
        $obj->digitalProductsDelivered = $digitalProductsDelivered;

        return $obj;
    }

    /**
     * List of disputes associated with this payment.
     *
     * @param list<Dispute> $disputes
     */
    public function withDisputes(array $disputes): self
    {
        $obj = clone $this;
        $obj->disputes = $disputes;

        return $obj;
    }

    /**
     * Additional custom data associated with the payment.
     *
     * @param array<string, string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Unique identifier for the payment.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->paymentID = $paymentID;

        return $obj;
    }

    /**
     * List of refunds issued for this payment.
     *
     * @param list<Refund> $refunds
     */
    public function withRefunds(array $refunds): self
    {
        $obj = clone $this;
        $obj->refunds = $refunds;

        return $obj;
    }

    /**
     * The amount that will be credited to your Dodo balance after currency conversion and processing.
     * Especially relevant for adaptive pricing where the customer's payment currency differs from your settlement currency.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $obj = clone $this;
        $obj->settlementAmount = $settlementAmount;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $settlementCurrency
     */
    public function withSettlementCurrency(
        Currency|string $settlementCurrency
    ): self {
        $obj = clone $this;
        $obj['settlementCurrency'] = $settlementCurrency;

        return $obj;
    }

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj->totalAmount = $totalAmount;

        return $obj;
    }

    /**
     * ISO country code alpha2 variant.
     *
     * @param CountryCode|value-of<CountryCode> $cardIssuingCountry
     */
    public function withCardIssuingCountry(
        CountryCode|string $cardIssuingCountry
    ): self {
        $obj = clone $this;
        $obj['cardIssuingCountry'] = $cardIssuingCountry;

        return $obj;
    }

    /**
     * The last four digits of the card.
     */
    public function withCardLastFour(?string $cardLastFour): self
    {
        $obj = clone $this;
        $obj->cardLastFour = $cardLastFour;

        return $obj;
    }

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    public function withCardNetwork(?string $cardNetwork): self
    {
        $obj = clone $this;
        $obj->cardNetwork = $cardNetwork;

        return $obj;
    }

    /**
     * The type of card DEBIT or CREDIT.
     */
    public function withCardType(?string $cardType): self
    {
        $obj = clone $this;
        $obj->cardType = $cardType;

        return $obj;
    }

    /**
     * If payment is made using a checkout session,
     * this field is set to the id of the session.
     */
    public function withCheckoutSessionID(?string $checkoutSessionID): self
    {
        $obj = clone $this;
        $obj->checkoutSessionID = $checkoutSessionID;

        return $obj;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $obj = clone $this;
        $obj->discountID = $discountID;

        return $obj;
    }

    /**
     * An error code if the payment failed.
     */
    public function withErrorCode(?string $errorCode): self
    {
        $obj = clone $this;
        $obj->errorCode = $errorCode;

        return $obj;
    }

    /**
     * An error message if the payment failed.
     */
    public function withErrorMessage(?string $errorMessage): self
    {
        $obj = clone $this;
        $obj->errorMessage = $errorMessage;

        return $obj;
    }

    /**
     * Checkout URL.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj->paymentLink = $paymentLink;

        return $obj;
    }

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    public function withPaymentMethod(?string $paymentMethod): self
    {
        $obj = clone $this;
        $obj->paymentMethod = $paymentMethod;

        return $obj;
    }

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $obj = clone $this;
        $obj->paymentMethodType = $paymentMethodType;

        return $obj;
    }

    /**
     * List of products purchased in a one-time payment.
     *
     * @param list<ProductCart>|null $productCart
     */
    public function withProductCart(?array $productCart): self
    {
        $obj = clone $this;
        $obj->productCart = $productCart;

        return $obj;
    }

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    public function withSettlementTax(?int $settlementTax): self
    {
        $obj = clone $this;
        $obj->settlementTax = $settlementTax;

        return $obj;
    }

    /**
     * @param IntentStatus|value-of<IntentStatus> $status
     */
    public function withStatus(IntentStatus|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Identifier of the subscription if payment is part of a subscription.
     */
    public function withSubscriptionID(?string $subscriptionID): self
    {
        $obj = clone $this;
        $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    public function withTax(?int $tax): self
    {
        $obj = clone $this;
        $obj->tax = $tax;

        return $obj;
    }

    /**
     * Timestamp when the payment was last updated.
     */
    public function withUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * The type of payload in the data field.
     *
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $obj = clone $this;
        $obj['payloadType'] = $payloadType;

        return $obj;
    }
}
