<?php

declare(strict_types=1);

namespace DodopaymentsClient\Payments;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\ListOf;
use DodopaymentsClient\Core\Conversion\MapOf;
use DodopaymentsClient\Disputes\Dispute;
use DodopaymentsClient\Misc\CountryCode;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Payments\Payment\ProductCart;
use DodopaymentsClient\Refunds\Refund;

/**
 * @phpstan-type payment_alias = array{
 *   billing: BillingAddress,
 *   brandID: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency::*,
 *   customer: CustomerLimitedDetails,
 *   digitalProductsDelivered: bool,
 *   disputes: list<Dispute>,
 *   metadata: array<string, string>,
 *   paymentID: string,
 *   refunds: list<Refund>,
 *   settlementAmount: int,
 *   settlementCurrency: Currency::*,
 *   totalAmount: int,
 *   cardIssuingCountry?: CountryCode::*,
 *   cardLastFour?: string|null,
 *   cardNetwork?: string|null,
 *   cardType?: string|null,
 *   discountID?: string|null,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   paymentLink?: string|null,
 *   paymentMethod?: string|null,
 *   paymentMethodType?: string|null,
 *   productCart?: list<ProductCart>|null,
 *   settlementTax?: int|null,
 *   status?: IntentStatus::*,
 *   subscriptionID?: string|null,
 *   tax?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Payment implements BaseModel
{
    use Model;

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
    #[Api(type: new ListOf(Dispute::class))]
    public array $disputes;

    /**
     * Additional custom data associated with the payment.
     *
     * @var array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'))]
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
    #[Api(type: new ListOf(Refund::class))]
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
     * @var null|CountryCode::* $cardIssuingCountry
     */
    #[Api('card_issuing_country', enum: CountryCode::class, optional: true)]
    public ?string $cardIssuingCountry;

    /**
     * The last four digits of the card.
     */
    #[Api('card_last_four', optional: true)]
    public ?string $cardLastFour;

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    #[Api('card_network', optional: true)]
    public ?string $cardNetwork;

    /**
     * The type of card DEBIT or CREDIT.
     */
    #[Api('card_type', optional: true)]
    public ?string $cardType;

    /**
     * The discount id if discount is applied.
     */
    #[Api('discount_id', optional: true)]
    public ?string $discountID;

    /**
     * An error code if the payment failed.
     */
    #[Api('error_code', optional: true)]
    public ?string $errorCode;

    /**
     * An error message if the payment failed.
     */
    #[Api('error_message', optional: true)]
    public ?string $errorMessage;

    /**
     * Checkout URL.
     */
    #[Api('payment_link', optional: true)]
    public ?string $paymentLink;

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    #[Api('payment_method', optional: true)]
    public ?string $paymentMethod;

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    #[Api('payment_method_type', optional: true)]
    public ?string $paymentMethodType;

    /**
     * List of products purchased in a one-time payment.
     *
     * @var null|list<ProductCart> $productCart
     */
    #[Api(
        'product_cart',
        type: new ListOf(ProductCart::class),
        nullable: true,
        optional: true,
    )]
    public ?array $productCart;

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    #[Api('settlement_tax', optional: true)]
    public ?int $settlementTax;

    /**
     * Current status of the payment intent.
     *
     * @var null|IntentStatus::* $status
     */
    #[Api(enum: IntentStatus::class, optional: true)]
    public ?string $status;

    /**
     * Identifier of the subscription if payment is part of a subscription.
     */
    #[Api('subscription_id', optional: true)]
    public ?string $subscriptionID;

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    #[Api(optional: true)]
    public ?int $tax;

    /**
     * Timestamp when the payment was last updated.
     */
    #[Api('updated_at', optional: true)]
    public ?\DateTimeInterface $updatedAt;

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
     * @param null|list<ProductCart> $productCart
     * @param IntentStatus::* $status
     */
    public static function from(
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
    public function setBilling(BillingAddress $billing): self
    {
        $this->billing = $billing;

        return $this;
    }

    /**
     * brand id this payment belongs to.
     */
    public function setBrandID(string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
    }

    /**
     * Identifier of the business associated with the payment.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * Timestamp when the payment was created.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Currency used for the payment.
     *
     * @param Currency::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Details about the customer who made the payment.
     */
    public function setCustomer(CustomerLimitedDetails $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * brand id this payment belongs to.
     */
    public function setDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $this->digitalProductsDelivered = $digitalProductsDelivered;

        return $this;
    }

    /**
     * List of disputes associated with this payment.
     *
     * @param list<Dispute> $disputes
     */
    public function setDisputes(array $disputes): self
    {
        $this->disputes = $disputes;

        return $this;
    }

    /**
     * Additional custom data associated with the payment.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Unique identifier for the payment.
     */
    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    /**
     * List of refunds issued for this payment.
     *
     * @param list<Refund> $refunds
     */
    public function setRefunds(array $refunds): self
    {
        $this->refunds = $refunds;

        return $this;
    }

    /**
     * The amount that will be credited to your Dodo balance after currency conversion and processing.
     * Especially relevant for adaptive pricing where the customer's payment currency differs from your settlement currency.
     */
    public function setSettlementAmount(int $settlementAmount): self
    {
        $this->settlementAmount = $settlementAmount;

        return $this;
    }

    /**
     * The currency in which the settlement_amount will be credited to your Dodo balance.
     * This may differ from the customer's payment currency in adaptive pricing scenarios.
     *
     * @param Currency::* $settlementCurrency
     */
    public function setSettlementCurrency(string $settlementCurrency): self
    {
        $this->settlementCurrency = $settlementCurrency;

        return $this;
    }

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents).
     */
    public function setTotalAmount(int $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * ISO2 country code of the card.
     *
     * @param CountryCode::* $cardIssuingCountry
     */
    public function setCardIssuingCountry(string $cardIssuingCountry): self
    {
        $this->cardIssuingCountry = $cardIssuingCountry;

        return $this;
    }

    /**
     * The last four digits of the card.
     */
    public function setCardLastFour(?string $cardLastFour): self
    {
        $this->cardLastFour = $cardLastFour;

        return $this;
    }

    /**
     * Card network like VISA, MASTERCARD etc.
     */
    public function setCardNetwork(?string $cardNetwork): self
    {
        $this->cardNetwork = $cardNetwork;

        return $this;
    }

    /**
     * The type of card DEBIT or CREDIT.
     */
    public function setCardType(?string $cardType): self
    {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * The discount id if discount is applied.
     */
    public function setDiscountID(?string $discountID): self
    {
        $this->discountID = $discountID;

        return $this;
    }

    /**
     * An error code if the payment failed.
     */
    public function setErrorCode(?string $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * An error message if the payment failed.
     */
    public function setErrorMessage(?string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * Checkout URL.
     */
    public function setPaymentLink(?string $paymentLink): self
    {
        $this->paymentLink = $paymentLink;

        return $this;
    }

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer").
     */
    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Specific type of payment method (e.g. "visa", "mastercard").
     */
    public function setPaymentMethodType(?string $paymentMethodType): self
    {
        $this->paymentMethodType = $paymentMethodType;

        return $this;
    }

    /**
     * List of products purchased in a one-time payment.
     *
     * @param null|list<ProductCart> $productCart
     */
    public function setProductCart(?array $productCart): self
    {
        $this->productCart = $productCart;

        return $this;
    }

    /**
     * This represents the portion of settlement_amount that corresponds to taxes collected.
     * Especially relevant for adaptive pricing where the tax component must be tracked separately
     * in your Dodo balance.
     */
    public function setSettlementTax(?int $settlementTax): self
    {
        $this->settlementTax = $settlementTax;

        return $this;
    }

    /**
     * Current status of the payment intent.
     *
     * @param IntentStatus::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Identifier of the subscription if payment is part of a subscription.
     */
    public function setSubscriptionID(?string $subscriptionID): self
    {
        $this->subscriptionID = $subscriptionID;

        return $this;
    }

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents).
     */
    public function setTax(?int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Timestamp when the payment was last updated.
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
