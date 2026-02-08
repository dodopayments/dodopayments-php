<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\Dispute;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\Payment\CustomFieldResponse;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Payments\Payment\Refund;
use Dodopayments\Payments\Payment\RefundStatus;

/**
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CustomerLimitedDetailsShape from \Dodopayments\Payments\CustomerLimitedDetails
 * @phpstan-import-type DisputeShape from \Dodopayments\Disputes\Dispute
 * @phpstan-import-type RefundShape from \Dodopayments\Payments\Payment\Refund
 * @phpstan-import-type CustomFieldResponseShape from \Dodopayments\Payments\Payment\CustomFieldResponse
 * @phpstan-import-type ProductCartShape from \Dodopayments\Payments\Payment\ProductCart
 *
 * @phpstan-type PaymentShape = array{
 *   billing: BillingAddress|BillingAddressShape,
 *   brandID: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   customer: CustomerLimitedDetails|CustomerLimitedDetailsShape,
 *   digitalProductsDelivered: bool,
 *   disputes: list<Dispute|DisputeShape>,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   refunds: list<Refund|RefundShape>,
 *   settlementAmount: int,
 *   settlementCurrency: Currency|value-of<Currency>,
 *   totalAmount: int,
 *   cardHolderName?: string|null,
 *   cardIssuingCountry?: null|CountryCode|value-of<CountryCode>,
 *   cardLastFour?: string|null,
 *   cardNetwork?: string|null,
 *   cardType?: string|null,
 *   checkoutSessionID?: string|null,
 *   customFieldResponses?: list<CustomFieldResponse|CustomFieldResponseShape>|null,
 *   discountID?: string|null,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   invoiceID?: string|null,
 *   invoiceURL?: string|null,
 *   paymentLink?: string|null,
 *   paymentMethod?: string|null,
 *   paymentMethodType?: string|null,
 *   productCart?: list<ProductCart|ProductCartShape>|null,
 *   refundStatus?: null|RefundStatus|value-of<RefundStatus>,
 *   settlementTax?: int|null,
 *   status?: null|IntentStatus|value-of<IntentStatus>,
 *   subscriptionID?: string|null,
 *   tax?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Payment implements BaseModel
{
    /** @use SdkModel<PaymentShape> */
    use SdkModel;

    /**
     * Billing address details for payments.
     */
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

    /**
     * Currency used for the payment.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Details about the customer who made the payment.
     */
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

    /**
     * The currency in which the settlement_amount will be credited to your Dodo balance.
     * This may differ from the customer's payment currency in adaptive pricing scenarios.
     *
     * @var value-of<Currency> $settlementCurrency
     */
    #[Required('settlement_currency', enum: Currency::class)]
    public string $settlementCurrency;

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    #[Required('total_amount')]
    public int $totalAmount;

    /**
     * Cardholder name.
     */
    #[Optional('card_holder_name', nullable: true)]
    public ?string $cardHolderName;

    /**
     * ISO2 country code of the card.
     *
     * @var value-of<CountryCode>|null $cardIssuingCountry
     */
    #[Optional('card_issuing_country', enum: CountryCode::class, nullable: true)]
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
     * Customer's responses to custom fields collected during checkout.
     *
     * @var list<CustomFieldResponse>|null $customFieldResponses
     */
    #[Optional(
        'custom_field_responses',
        list: CustomFieldResponse::class,
        nullable: true
    )]
    public ?array $customFieldResponses;

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
     * Invoice ID for this payment. Uses India-specific invoice ID if available.
     */
    #[Optional('invoice_id', nullable: true)]
    public ?string $invoiceID;

    /**
     * URL to download the invoice PDF for this payment.
     */
    #[Optional('invoice_url', nullable: true)]
    public ?string $invoiceURL;

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
     * Summary of the refund status for this payment. None if no succeeded refunds exist.
     *
     * @var value-of<RefundStatus>|null $refundStatus
     */
    #[Optional('refund_status', enum: RefundStatus::class, nullable: true)]
    public ?string $refundStatus;

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    #[Optional('settlement_tax', nullable: true)]
    public ?int $settlementTax;

    /**
     * Current status of the payment intent.
     *
     * @var value-of<IntentStatus>|null $status
     */
    #[Optional(enum: IntentStatus::class, nullable: true)]
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
     * `new Payment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payment::with(
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
     * (new Payment)
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
     * @param BillingAddress|BillingAddressShape $billing
     * @param Currency|value-of<Currency> $currency
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
     * @param list<Dispute|DisputeShape> $disputes
     * @param array<string,string> $metadata
     * @param list<Refund|RefundShape> $refunds
     * @param Currency|value-of<Currency> $settlementCurrency
     * @param CountryCode|value-of<CountryCode>|null $cardIssuingCountry
     * @param list<CustomFieldResponse|CustomFieldResponseShape>|null $customFieldResponses
     * @param list<ProductCart|ProductCartShape>|null $productCart
     * @param RefundStatus|value-of<RefundStatus>|null $refundStatus
     * @param IntentStatus|value-of<IntentStatus>|null $status
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
        ?string $cardHolderName = null,
        CountryCode|string|null $cardIssuingCountry = null,
        ?string $cardLastFour = null,
        ?string $cardNetwork = null,
        ?string $cardType = null,
        ?string $checkoutSessionID = null,
        ?array $customFieldResponses = null,
        ?string $discountID = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?string $invoiceID = null,
        ?string $invoiceURL = null,
        ?string $paymentLink = null,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        ?array $productCart = null,
        RefundStatus|string|null $refundStatus = null,
        ?int $settlementTax = null,
        IntentStatus|string|null $status = null,
        ?string $subscriptionID = null,
        ?int $tax = null,
        ?\DateTimeInterface $updatedAt = null,
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

        null !== $cardHolderName && $self['cardHolderName'] = $cardHolderName;
        null !== $cardIssuingCountry && $self['cardIssuingCountry'] = $cardIssuingCountry;
        null !== $cardLastFour && $self['cardLastFour'] = $cardLastFour;
        null !== $cardNetwork && $self['cardNetwork'] = $cardNetwork;
        null !== $cardType && $self['cardType'] = $cardType;
        null !== $checkoutSessionID && $self['checkoutSessionID'] = $checkoutSessionID;
        null !== $customFieldResponses && $self['customFieldResponses'] = $customFieldResponses;
        null !== $discountID && $self['discountID'] = $discountID;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $invoiceID && $self['invoiceID'] = $invoiceID;
        null !== $invoiceURL && $self['invoiceURL'] = $invoiceURL;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;
        null !== $paymentMethod && $self['paymentMethod'] = $paymentMethod;
        null !== $paymentMethodType && $self['paymentMethodType'] = $paymentMethodType;
        null !== $productCart && $self['productCart'] = $productCart;
        null !== $refundStatus && $self['refundStatus'] = $refundStatus;
        null !== $settlementTax && $self['settlementTax'] = $settlementTax;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;
        null !== $tax && $self['tax'] = $tax;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Billing address details for payments.
     *
     * @param BillingAddress|BillingAddressShape $billing
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
     * Currency used for the payment.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Details about the customer who made the payment.
     *
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
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
     * @param list<Dispute|DisputeShape> $disputes
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
     * @param list<Refund|RefundShape> $refunds
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
     * The currency in which the settlement_amount will be credited to your Dodo balance.
     * This may differ from the customer's payment currency in adaptive pricing scenarios.
     *
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
     * Cardholder name.
     */
    public function withCardHolderName(?string $cardHolderName): self
    {
        $self = clone $this;
        $self['cardHolderName'] = $cardHolderName;

        return $self;
    }

    /**
     * ISO2 country code of the card.
     *
     * @param CountryCode|value-of<CountryCode>|null $cardIssuingCountry
     */
    public function withCardIssuingCountry(
        CountryCode|string|null $cardIssuingCountry
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
     * Customer's responses to custom fields collected during checkout.
     *
     * @param list<CustomFieldResponse|CustomFieldResponseShape>|null $customFieldResponses
     */
    public function withCustomFieldResponses(?array $customFieldResponses): self
    {
        $self = clone $this;
        $self['customFieldResponses'] = $customFieldResponses;

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
     * Invoice ID for this payment. Uses India-specific invoice ID if available.
     */
    public function withInvoiceID(?string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    /**
     * URL to download the invoice PDF for this payment.
     */
    public function withInvoiceURL(?string $invoiceURL): self
    {
        $self = clone $this;
        $self['invoiceURL'] = $invoiceURL;

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
     * @param list<ProductCart|ProductCartShape>|null $productCart
     */
    public function withProductCart(?array $productCart): self
    {
        $self = clone $this;
        $self['productCart'] = $productCart;

        return $self;
    }

    /**
     * Summary of the refund status for this payment. None if no succeeded refunds exist.
     *
     * @param RefundStatus|value-of<RefundStatus>|null $refundStatus
     */
    public function withRefundStatus(
        RefundStatus|string|null $refundStatus
    ): self {
        $self = clone $this;
        $self['refundStatus'] = $refundStatus;

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
     * Current status of the payment intent.
     *
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public function withStatus(IntentStatus|string|null $status): self
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
}
