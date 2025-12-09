<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

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
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment\PayloadType;

/**
 * @phpstan-type PaymentShape = array{
 *   billing: BillingAddress,
 *   brand_id: string,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer: CustomerLimitedDetails,
 *   digital_products_delivered: bool,
 *   disputes: list<\Dodopayments\Disputes\Dispute>,
 *   metadata: array<string,string>,
 *   payment_id: string,
 *   refunds: list<\Dodopayments\Payments\Payment\Refund>,
 *   settlement_amount: int,
 *   settlement_currency: value-of<Currency>,
 *   total_amount: int,
 *   card_issuing_country?: value-of<CountryCode>|null,
 *   card_last_four?: string|null,
 *   card_network?: string|null,
 *   card_type?: string|null,
 *   checkout_session_id?: string|null,
 *   discount_id?: string|null,
 *   error_code?: string|null,
 *   error_message?: string|null,
 *   payment_link?: string|null,
 *   payment_method?: string|null,
 *   payment_method_type?: string|null,
 *   product_cart?: list<ProductCart>|null,
 *   settlement_tax?: int|null,
 *   status?: value-of<IntentStatus>|null,
 *   subscription_id?: string|null,
 *   tax?: int|null,
 *   updated_at?: \DateTimeInterface|null,
 *   payload_type: value-of<PayloadType>,
 * }
 */
final class Payment implements BaseModel
{
    /** @use SdkModel<PaymentShape> */
    use SdkModel;

    #[Required]
    public BillingAddress $billing;

    /**
     * brand id this payment belongs to.
     */
    #[Required]
    public string $brand_id;

    /**
     * Identifier of the business associated with the payment.
     */
    #[Required]
    public string $business_id;

    /**
     * Timestamp when the payment was created.
     */
    #[Required]
    public \DateTimeInterface $created_at;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * brand id this payment belongs to.
     */
    #[Required]
    public bool $digital_products_delivered;

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
    #[Required]
    public string $payment_id;

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
    #[Required]
    public int $settlement_amount;

    /** @var value-of<Currency> $settlement_currency */
    #[Required(enum: Currency::class)]
    public string $settlement_currency;

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    #[Required]
    public int $total_amount;

    /**
     * ISO country code alpha2 variant.
     *
     * @var value-of<CountryCode>|null $card_issuing_country
     */
    #[Optional(enum: CountryCode::class)]
    public ?string $card_issuing_country;

    /**
     * The last four digits of the card.
     */
    #[Optional(nullable: true)]
    public ?string $card_last_four;

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    #[Optional(nullable: true)]
    public ?string $card_network;

    /**
     * The type of card DEBIT or CREDIT.
     */
    #[Optional(nullable: true)]
    public ?string $card_type;

    /**
     * If payment is made using a checkout session,
     * this field is set to the id of the session.
     */
    #[Optional(nullable: true)]
    public ?string $checkout_session_id;

    /**
     * The discount id if discount is applied.
     */
    #[Optional(nullable: true)]
    public ?string $discount_id;

    /**
     * An error code if the payment failed.
     */
    #[Optional(nullable: true)]
    public ?string $error_code;

    /**
     * An error message if the payment failed.
     */
    #[Optional(nullable: true)]
    public ?string $error_message;

    /**
     * Checkout URL.
     */
    #[Optional(nullable: true)]
    public ?string $payment_link;

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    #[Optional(nullable: true)]
    public ?string $payment_method;

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    #[Optional(nullable: true)]
    public ?string $payment_method_type;

    /**
     * List of products purchased in a one-time payment.
     *
     * @var list<ProductCart>|null $product_cart
     */
    #[Optional(list: ProductCart::class, nullable: true)]
    public ?array $product_cart;

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    #[Optional(nullable: true)]
    public ?int $settlement_tax;

    /** @var value-of<IntentStatus>|null $status */
    #[Optional(enum: IntentStatus::class)]
    public ?string $status;

    /**
     * Identifier of the subscription if payment is part of a subscription.
     */
    #[Optional(nullable: true)]
    public ?string $subscription_id;

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * Timestamp when the payment was last updated.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $updated_at;

    /** @var value-of<PayloadType> $payload_type */
    #[Required(enum: PayloadType::class)]
    public string $payload_type;

    /**
     * `new Payment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payment::with(
     *   billing: ...,
     *   brand_id: ...,
     *   business_id: ...,
     *   created_at: ...,
     *   currency: ...,
     *   customer: ...,
     *   digital_products_delivered: ...,
     *   disputes: ...,
     *   metadata: ...,
     *   payment_id: ...,
     *   refunds: ...,
     *   settlement_amount: ...,
     *   settlement_currency: ...,
     *   total_amount: ...,
     *   payload_type: ...,
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
     *   ->withPayloadType(...)
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
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     * @param list<Dispute|array{
     *   amount: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: string,
     *   dispute_id: string,
     *   dispute_stage: value-of<DisputeStage>,
     *   dispute_status: value-of<DisputeStatus>,
     *   payment_id: string,
     *   remarks?: string|null,
     * }> $disputes
     * @param array<string,string> $metadata
     * @param list<Refund|array{
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   is_partial: bool,
     *   payment_id: string,
     *   refund_id: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     * }> $refunds
     * @param Currency|value-of<Currency> $settlement_currency
     * @param PayloadType|value-of<PayloadType> $payload_type
     * @param CountryCode|value-of<CountryCode> $card_issuing_country
     * @param list<ProductCart|array{
     *   product_id: string, quantity: int
     * }>|null $product_cart
     * @param IntentStatus|value-of<IntentStatus> $status
     */
    public static function with(
        BillingAddress|array $billing,
        string $brand_id,
        string $business_id,
        \DateTimeInterface $created_at,
        Currency|string $currency,
        CustomerLimitedDetails|array $customer,
        bool $digital_products_delivered,
        array $disputes,
        array $metadata,
        string $payment_id,
        array $refunds,
        int $settlement_amount,
        Currency|string $settlement_currency,
        int $total_amount,
        PayloadType|string $payload_type,
        CountryCode|string|null $card_issuing_country = null,
        ?string $card_last_four = null,
        ?string $card_network = null,
        ?string $card_type = null,
        ?string $checkout_session_id = null,
        ?string $discount_id = null,
        ?string $error_code = null,
        ?string $error_message = null,
        ?string $payment_link = null,
        ?string $payment_method = null,
        ?string $payment_method_type = null,
        ?array $product_cart = null,
        ?int $settlement_tax = null,
        IntentStatus|string|null $status = null,
        ?string $subscription_id = null,
        ?int $tax = null,
        ?\DateTimeInterface $updated_at = null,
    ): self {
        $obj = new self;

        $obj['billing'] = $billing;
        $obj['brand_id'] = $brand_id;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['currency'] = $currency;
        $obj['customer'] = $customer;
        $obj['digital_products_delivered'] = $digital_products_delivered;
        $obj['disputes'] = $disputes;
        $obj['metadata'] = $metadata;
        $obj['payment_id'] = $payment_id;
        $obj['refunds'] = $refunds;
        $obj['settlement_amount'] = $settlement_amount;
        $obj['settlement_currency'] = $settlement_currency;
        $obj['total_amount'] = $total_amount;
        $obj['payload_type'] = $payload_type;

        null !== $card_issuing_country && $obj['card_issuing_country'] = $card_issuing_country;
        null !== $card_last_four && $obj['card_last_four'] = $card_last_four;
        null !== $card_network && $obj['card_network'] = $card_network;
        null !== $card_type && $obj['card_type'] = $card_type;
        null !== $checkout_session_id && $obj['checkout_session_id'] = $checkout_session_id;
        null !== $discount_id && $obj['discount_id'] = $discount_id;
        null !== $error_code && $obj['error_code'] = $error_code;
        null !== $error_message && $obj['error_message'] = $error_message;
        null !== $payment_link && $obj['payment_link'] = $payment_link;
        null !== $payment_method && $obj['payment_method'] = $payment_method;
        null !== $payment_method_type && $obj['payment_method_type'] = $payment_method_type;
        null !== $product_cart && $obj['product_cart'] = $product_cart;
        null !== $settlement_tax && $obj['settlement_tax'] = $settlement_tax;
        null !== $status && $obj['status'] = $status;
        null !== $subscription_id && $obj['subscription_id'] = $subscription_id;
        null !== $tax && $obj['tax'] = $tax;
        null !== $updated_at && $obj['updated_at'] = $updated_at;

        return $obj;
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
        $obj = clone $this;
        $obj['billing'] = $billing;

        return $obj;
    }

    /**
     * brand id this payment belongs to.
     */
    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * Identifier of the business associated with the payment.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Timestamp when the payment was created.
     */
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

    /**
     * brand id this payment belongs to.
     */
    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $obj = clone $this;
        $obj['digital_products_delivered'] = $digitalProductsDelivered;

        return $obj;
    }

    /**
     * List of disputes associated with this payment.
     *
     * @param list<Dispute|array{
     *   amount: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: string,
     *   dispute_id: string,
     *   dispute_stage: value-of<DisputeStage>,
     *   dispute_status: value-of<DisputeStatus>,
     *   payment_id: string,
     *   remarks?: string|null,
     * }> $disputes
     */
    public function withDisputes(array $disputes): self
    {
        $obj = clone $this;
        $obj['disputes'] = $disputes;

        return $obj;
    }

    /**
     * Additional custom data associated with the payment.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Unique identifier for the payment.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['payment_id'] = $paymentID;

        return $obj;
    }

    /**
     * List of refunds issued for this payment.
     *
     * @param list<Refund|array{
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   is_partial: bool,
     *   payment_id: string,
     *   refund_id: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     * }> $refunds
     */
    public function withRefunds(array $refunds): self
    {
        $obj = clone $this;
        $obj['refunds'] = $refunds;

        return $obj;
    }

    /**
     * The amount that will be credited to your Dodo balance after currency conversion and processing.
     * Especially relevant for adaptive pricing where the customer's payment currency differs from your settlement currency.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $obj = clone $this;
        $obj['settlement_amount'] = $settlementAmount;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $settlementCurrency
     */
    public function withSettlementCurrency(
        Currency|string $settlementCurrency
    ): self {
        $obj = clone $this;
        $obj['settlement_currency'] = $settlementCurrency;

        return $obj;
    }

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj['total_amount'] = $totalAmount;

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
        $obj['card_issuing_country'] = $cardIssuingCountry;

        return $obj;
    }

    /**
     * The last four digits of the card.
     */
    public function withCardLastFour(?string $cardLastFour): self
    {
        $obj = clone $this;
        $obj['card_last_four'] = $cardLastFour;

        return $obj;
    }

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    public function withCardNetwork(?string $cardNetwork): self
    {
        $obj = clone $this;
        $obj['card_network'] = $cardNetwork;

        return $obj;
    }

    /**
     * The type of card DEBIT or CREDIT.
     */
    public function withCardType(?string $cardType): self
    {
        $obj = clone $this;
        $obj['card_type'] = $cardType;

        return $obj;
    }

    /**
     * If payment is made using a checkout session,
     * this field is set to the id of the session.
     */
    public function withCheckoutSessionID(?string $checkoutSessionID): self
    {
        $obj = clone $this;
        $obj['checkout_session_id'] = $checkoutSessionID;

        return $obj;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $obj = clone $this;
        $obj['discount_id'] = $discountID;

        return $obj;
    }

    /**
     * An error code if the payment failed.
     */
    public function withErrorCode(?string $errorCode): self
    {
        $obj = clone $this;
        $obj['error_code'] = $errorCode;

        return $obj;
    }

    /**
     * An error message if the payment failed.
     */
    public function withErrorMessage(?string $errorMessage): self
    {
        $obj = clone $this;
        $obj['error_message'] = $errorMessage;

        return $obj;
    }

    /**
     * Checkout URL.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj['payment_link'] = $paymentLink;

        return $obj;
    }

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    public function withPaymentMethod(?string $paymentMethod): self
    {
        $obj = clone $this;
        $obj['payment_method'] = $paymentMethod;

        return $obj;
    }

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $obj = clone $this;
        $obj['payment_method_type'] = $paymentMethodType;

        return $obj;
    }

    /**
     * List of products purchased in a one-time payment.
     *
     * @param list<ProductCart|array{
     *   product_id: string, quantity: int
     * }>|null $productCart
     */
    public function withProductCart(?array $productCart): self
    {
        $obj = clone $this;
        $obj['product_cart'] = $productCart;

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
        $obj['settlement_tax'] = $settlementTax;

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
        $obj['subscription_id'] = $subscriptionID;

        return $obj;
    }

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    public function withTax(?int $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }

    /**
     * Timestamp when the payment was last updated.
     */
    public function withUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

        return $obj;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $obj = clone $this;
        $obj['payload_type'] = $payloadType;

        return $obj;
    }
}
