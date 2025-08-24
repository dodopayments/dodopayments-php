<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\Dispute;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Refunds\Refund;

final class Payment implements BaseModel
{
    use SdkModel;

    /**
     * Billing address details for payments.
     */
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

    /**
     * Currency used for the payment.
     *
     * @var Currency::* $currency
     */
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * Details about the customer who made the payment.
     */
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

    /**
     * The currency in which the settlement_amount will be credited to your Dodo balance.
     * This may differ from the customer's payment currency in adaptive pricing scenarios.
     *
     * @var Currency::* $settlementCurrency
     */
    #[Api('settlement_currency', enum: Currency::class)]
    public string $settlementCurrency;

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    #[Api('total_amount')]
    public int $totalAmount;

    /**
     * ISO2 country code of the card.
     *
     * @var CountryCode::*|null $cardIssuingCountry
     */
    #[Api(
        'card_issuing_country',
        enum: CountryCode::class,
        nullable: true,
        optional: true,
    )]
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

    /**
     * Current status of the payment intent.
     *
     * @var IntentStatus::*|null $status
     */
    #[Api(enum: IntentStatus::class, nullable: true, optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency::* $currency
     * @param list<Dispute> $disputes
     * @param array<string, string> $metadata
     * @param list<Refund> $refunds
     * @param Currency::* $settlementCurrency
     * @param CountryCode::* $cardIssuingCountry
     * @param list<ProductCart>|null $productCart
     * @param IntentStatus::* $status
     */
    public static function with(
        BillingAddress $billing,
        string $brandID,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $currency,
        CustomerLimitedDetails $customer,
        bool $digitalProductsDelivered,
        array $disputes,
        array $metadata,
        string $paymentID,
        array $refunds,
        int $settlementAmount,
        string $settlementCurrency,
        int $totalAmount,
        ?string $cardIssuingCountry = null,
        ?string $cardLastFour = null,
        ?string $cardNetwork = null,
        ?string $cardType = null,
        ?string $discountID = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?string $paymentLink = null,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        ?array $productCart = null,
        ?int $settlementTax = null,
        ?string $status = null,
        ?string $subscriptionID = null,
        ?int $tax = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $obj = new self;

        $obj->billing = $billing;
        $obj->brandID = $brandID;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency;
        $obj->customer = $customer;
        $obj->digitalProductsDelivered = $digitalProductsDelivered;
        $obj->disputes = $disputes;
        $obj->metadata = $metadata;
        $obj->paymentID = $paymentID;
        $obj->refunds = $refunds;
        $obj->settlementAmount = $settlementAmount;
        $obj->settlementCurrency = $settlementCurrency;
        $obj->totalAmount = $totalAmount;

        null !== $cardIssuingCountry && $obj->cardIssuingCountry = $cardIssuingCountry;
        null !== $cardLastFour && $obj->cardLastFour = $cardLastFour;
        null !== $cardNetwork && $obj->cardNetwork = $cardNetwork;
        null !== $cardType && $obj->cardType = $cardType;
        null !== $discountID && $obj->discountID = $discountID;
        null !== $errorCode && $obj->errorCode = $errorCode;
        null !== $errorMessage && $obj->errorMessage = $errorMessage;
        null !== $paymentLink && $obj->paymentLink = $paymentLink;
        null !== $paymentMethod && $obj->paymentMethod = $paymentMethod;
        null !== $paymentMethodType && $obj->paymentMethodType = $paymentMethodType;
        null !== $productCart && $obj->productCart = $productCart;
        null !== $settlementTax && $obj->settlementTax = $settlementTax;
        null !== $status && $obj->status = $status;
        null !== $subscriptionID && $obj->subscriptionID = $subscriptionID;
        null !== $tax && $obj->tax = $tax;
        null !== $updatedAt && $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * Billing address details for payments.
     */
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
     * Currency used for the payment.
     *
     * @param Currency::* $currency
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

        return $obj;
    }

    /**
     * Details about the customer who made the payment.
     */
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
     * The currency in which the settlement_amount will be credited to your Dodo balance.
     * This may differ from the customer's payment currency in adaptive pricing scenarios.
     *
     * @param Currency::* $settlementCurrency
     */
    public function withSettlementCurrency(string $settlementCurrency): self
    {
        $obj = clone $this;
        $obj->settlementCurrency = $settlementCurrency;

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
     * ISO2 country code of the card.
     *
     * @param CountryCode::* $cardIssuingCountry
     */
    public function withCardIssuingCountry(string $cardIssuingCountry): self
    {
        $obj = clone $this;
        $obj->cardIssuingCountry = $cardIssuingCountry;

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
     * Current status of the payment intent.
     *
     * @param IntentStatus::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

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
}
