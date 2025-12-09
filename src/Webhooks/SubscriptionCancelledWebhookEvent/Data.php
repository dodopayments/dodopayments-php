<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionCancelledWebhookEvent;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Subscriptions\AddonCartResponseItem;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\TimeInterval;
use Dodopayments\Webhooks\SubscriptionCancelledWebhookEvent\Data\PayloadType;

/**
 * Event-specific data.
 *
 * @phpstan-type DataShape = array{
 *   addons: list<AddonCartResponseItem>,
 *   billing: BillingAddress,
 *   cancelAtNextBillingDate: bool,
 *   createdAt: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string,string>,
 *   meters: list<Meter>,
 *   nextBillingDate: \DateTimeInterface,
 *   onDemand: bool,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: value-of<TimeInterval>,
 *   previousBillingDate: \DateTimeInterface,
 *   productID: string,
 *   quantity: int,
 *   recurringPreTaxAmount: int,
 *   status: value-of<SubscriptionStatus>,
 *   subscriptionID: string,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: value-of<TimeInterval>,
 *   taxInclusive: bool,
 *   trialPeriodDays: int,
 *   cancelledAt?: \DateTimeInterface|null,
 *   discountCyclesRemaining?: int|null,
 *   discountID?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   paymentMethodID?: string|null,
 *   taxID?: string|null,
 *   payloadType?: value-of<PayloadType>|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Addons associated with this subscription.
     *
     * @var list<AddonCartResponseItem> $addons
     */
    #[Required(list: AddonCartResponseItem::class)]
    public array $addons;

    #[Required]
    public BillingAddress $billing;

    /**
     * Indicates if the subscription will cancel at the next billing date.
     */
    #[Required('cancel_at_next_billing_date')]
    public bool $cancelAtNextBillingDate;

    /**
     * Timestamp when the subscription was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * Additional custom data associated with the subscription.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Meters associated with this subscription (for usage-based billing).
     *
     * @var list<Meter> $meters
     */
    #[Required(list: Meter::class)]
    public array $meters;

    /**
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    #[Required('next_billing_date')]
    public \DateTimeInterface $nextBillingDate;

    /**
     * Wether the subscription is on-demand or not.
     */
    #[Required('on_demand')]
    public bool $onDemand;

    /**
     * Number of payment frequency intervals.
     */
    #[Required('payment_frequency_count')]
    public int $paymentFrequencyCount;

    /** @var value-of<TimeInterval> $paymentFrequencyInterval */
    #[Required('payment_frequency_interval', enum: TimeInterval::class)]
    public string $paymentFrequencyInterval;

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    #[Required('previous_billing_date')]
    public \DateTimeInterface $previousBillingDate;

    /**
     * Identifier of the product associated with this subscription.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Number of units/items included in the subscription.
     */
    #[Required]
    public int $quantity;

    /**
     * Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents).
     */
    #[Required('recurring_pre_tax_amount')]
    public int $recurringPreTaxAmount;

    /** @var value-of<SubscriptionStatus> $status */
    #[Required(enum: SubscriptionStatus::class)]
    public string $status;

    /**
     * Unique identifier for the subscription.
     */
    #[Required('subscription_id')]
    public string $subscriptionID;

    /**
     * Number of subscription period intervals.
     */
    #[Required('subscription_period_count')]
    public int $subscriptionPeriodCount;

    /** @var value-of<TimeInterval> $subscriptionPeriodInterval */
    #[Required('subscription_period_interval', enum: TimeInterval::class)]
    public string $subscriptionPeriodInterval;

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    #[Required('tax_inclusive')]
    public bool $taxInclusive;

    /**
     * Number of days in the trial period (0 if no trial).
     */
    #[Required('trial_period_days')]
    public int $trialPeriodDays;

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    #[Optional('cancelled_at', nullable: true)]
    public ?\DateTimeInterface $cancelledAt;

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    #[Optional('discount_cycles_remaining', nullable: true)]
    public ?int $discountCyclesRemaining;

    /**
     * The discount id if discount is applied.
     */
    #[Optional('discount_id', nullable: true)]
    public ?string $discountID;

    /**
     * Timestamp when the subscription will expire.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Saved payment method id used for recurring charges.
     */
    #[Optional('payment_method_id', nullable: true)]
    public ?string $paymentMethodID;

    /**
     * Tax identifier provided for this subscription (if applicable).
     */
    #[Optional('tax_id', nullable: true)]
    public ?string $taxID;

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
     *   addons: ...,
     *   billing: ...,
     *   cancelAtNextBillingDate: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customer: ...,
     *   metadata: ...,
     *   meters: ...,
     *   nextBillingDate: ...,
     *   onDemand: ...,
     *   paymentFrequencyCount: ...,
     *   paymentFrequencyInterval: ...,
     *   previousBillingDate: ...,
     *   productID: ...,
     *   quantity: ...,
     *   recurringPreTaxAmount: ...,
     *   status: ...,
     *   subscriptionID: ...,
     *   subscriptionPeriodCount: ...,
     *   subscriptionPeriodInterval: ...,
     *   taxInclusive: ...,
     *   trialPeriodDays: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withAddons(...)
     *   ->withBilling(...)
     *   ->withCancelAtNextBillingDate(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withMetadata(...)
     *   ->withMeters(...)
     *   ->withNextBillingDate(...)
     *   ->withOnDemand(...)
     *   ->withPaymentFrequencyCount(...)
     *   ->withPaymentFrequencyInterval(...)
     *   ->withPreviousBillingDate(...)
     *   ->withProductID(...)
     *   ->withQuantity(...)
     *   ->withRecurringPreTaxAmount(...)
     *   ->withStatus(...)
     *   ->withSubscriptionID(...)
     *   ->withSubscriptionPeriodCount(...)
     *   ->withSubscriptionPeriodInterval(...)
     *   ->withTaxInclusive(...)
     *   ->withTrialPeriodDays(...)
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
     * @param list<AddonCartResponseItem|array{addonID: string, quantity: int}> $addons
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
     * @param array<string,string> $metadata
     * @param list<Meter|array{
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   measurementUnit: string,
     *   meterID: string,
     *   name: string,
     *   pricePerUnit: string,
     *   description?: string|null,
     * }> $meters
     * @param TimeInterval|value-of<TimeInterval> $paymentFrequencyInterval
     * @param SubscriptionStatus|value-of<SubscriptionStatus> $status
     * @param TimeInterval|value-of<TimeInterval> $subscriptionPeriodInterval
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public static function with(
        array $addons,
        BillingAddress|array $billing,
        bool $cancelAtNextBillingDate,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        CustomerLimitedDetails|array $customer,
        array $metadata,
        array $meters,
        \DateTimeInterface $nextBillingDate,
        bool $onDemand,
        int $paymentFrequencyCount,
        TimeInterval|string $paymentFrequencyInterval,
        \DateTimeInterface $previousBillingDate,
        string $productID,
        int $quantity,
        int $recurringPreTaxAmount,
        SubscriptionStatus|string $status,
        string $subscriptionID,
        int $subscriptionPeriodCount,
        TimeInterval|string $subscriptionPeriodInterval,
        bool $taxInclusive,
        int $trialPeriodDays,
        ?\DateTimeInterface $cancelledAt = null,
        ?int $discountCyclesRemaining = null,
        ?string $discountID = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $paymentMethodID = null,
        ?string $taxID = null,
        PayloadType|string|null $payloadType = null,
    ): self {
        $obj = new self;

        $obj['addons'] = $addons;
        $obj['billing'] = $billing;
        $obj['cancelAtNextBillingDate'] = $cancelAtNextBillingDate;
        $obj['createdAt'] = $createdAt;
        $obj['currency'] = $currency;
        $obj['customer'] = $customer;
        $obj['metadata'] = $metadata;
        $obj['meters'] = $meters;
        $obj['nextBillingDate'] = $nextBillingDate;
        $obj['onDemand'] = $onDemand;
        $obj['paymentFrequencyCount'] = $paymentFrequencyCount;
        $obj['paymentFrequencyInterval'] = $paymentFrequencyInterval;
        $obj['previousBillingDate'] = $previousBillingDate;
        $obj['productID'] = $productID;
        $obj['quantity'] = $quantity;
        $obj['recurringPreTaxAmount'] = $recurringPreTaxAmount;
        $obj['status'] = $status;
        $obj['subscriptionID'] = $subscriptionID;
        $obj['subscriptionPeriodCount'] = $subscriptionPeriodCount;
        $obj['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;
        $obj['taxInclusive'] = $taxInclusive;
        $obj['trialPeriodDays'] = $trialPeriodDays;

        null !== $cancelledAt && $obj['cancelledAt'] = $cancelledAt;
        null !== $discountCyclesRemaining && $obj['discountCyclesRemaining'] = $discountCyclesRemaining;
        null !== $discountID && $obj['discountID'] = $discountID;
        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;
        null !== $paymentMethodID && $obj['paymentMethodID'] = $paymentMethodID;
        null !== $taxID && $obj['taxID'] = $taxID;
        null !== $payloadType && $obj['payloadType'] = $payloadType;

        return $obj;
    }

    /**
     * Addons associated with this subscription.
     *
     * @param list<AddonCartResponseItem|array{addonID: string, quantity: int}> $addons
     */
    public function withAddons(array $addons): self
    {
        $obj = clone $this;
        $obj['addons'] = $addons;

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
     * Indicates if the subscription will cancel at the next billing date.
     */
    public function withCancelAtNextBillingDate(
        bool $cancelAtNextBillingDate
    ): self {
        $obj = clone $this;
        $obj['cancelAtNextBillingDate'] = $cancelAtNextBillingDate;

        return $obj;
    }

    /**
     * Timestamp when the subscription was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

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
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    /**
     * Additional custom data associated with the subscription.
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
     * Meters associated with this subscription (for usage-based billing).
     *
     * @param list<Meter|array{
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   measurementUnit: string,
     *   meterID: string,
     *   name: string,
     *   pricePerUnit: string,
     *   description?: string|null,
     * }> $meters
     */
    public function withMeters(array $meters): self
    {
        $obj = clone $this;
        $obj['meters'] = $meters;

        return $obj;
    }

    /**
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    public function withNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj['nextBillingDate'] = $nextBillingDate;

        return $obj;
    }

    /**
     * Wether the subscription is on-demand or not.
     */
    public function withOnDemand(bool $onDemand): self
    {
        $obj = clone $this;
        $obj['onDemand'] = $onDemand;

        return $obj;
    }

    /**
     * Number of payment frequency intervals.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $obj = clone $this;
        $obj['paymentFrequencyCount'] = $paymentFrequencyCount;

        return $obj;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $paymentFrequencyInterval
     */
    public function withPaymentFrequencyInterval(
        TimeInterval|string $paymentFrequencyInterval
    ): self {
        $obj = clone $this;
        $obj['paymentFrequencyInterval'] = $paymentFrequencyInterval;

        return $obj;
    }

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    public function withPreviousBillingDate(
        \DateTimeInterface $previousBillingDate
    ): self {
        $obj = clone $this;
        $obj['previousBillingDate'] = $previousBillingDate;

        return $obj;
    }

    /**
     * Identifier of the product associated with this subscription.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['productID'] = $productID;

        return $obj;
    }

    /**
     * Number of units/items included in the subscription.
     */
    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj['quantity'] = $quantity;

        return $obj;
    }

    /**
     * Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents).
     */
    public function withRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $obj = clone $this;
        $obj['recurringPreTaxAmount'] = $recurringPreTaxAmount;

        return $obj;
    }

    /**
     * @param SubscriptionStatus|value-of<SubscriptionStatus> $status
     */
    public function withStatus(SubscriptionStatus|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $obj = clone $this;
        $obj['subscriptionID'] = $subscriptionID;

        return $obj;
    }

    /**
     * Number of subscription period intervals.
     */
    public function withSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $obj = clone $this;
        $obj['subscriptionPeriodCount'] = $subscriptionPeriodCount;

        return $obj;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $subscriptionPeriodInterval
     */
    public function withSubscriptionPeriodInterval(
        TimeInterval|string $subscriptionPeriodInterval
    ): self {
        $obj = clone $this;
        $obj['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;

        return $obj;
    }

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['taxInclusive'] = $taxInclusive;

        return $obj;
    }

    /**
     * Number of days in the trial period (0 if no trial).
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj['trialPeriodDays'] = $trialPeriodDays;

        return $obj;
    }

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    public function withCancelledAt(?\DateTimeInterface $cancelledAt): self
    {
        $obj = clone $this;
        $obj['cancelledAt'] = $cancelledAt;

        return $obj;
    }

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    public function withDiscountCyclesRemaining(
        ?int $discountCyclesRemaining
    ): self {
        $obj = clone $this;
        $obj['discountCyclesRemaining'] = $discountCyclesRemaining;

        return $obj;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $obj = clone $this;
        $obj['discountID'] = $discountID;

        return $obj;
    }

    /**
     * Timestamp when the subscription will expire.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj['expiresAt'] = $expiresAt;

        return $obj;
    }

    /**
     * Saved payment method id used for recurring charges.
     */
    public function withPaymentMethodID(?string $paymentMethodID): self
    {
        $obj = clone $this;
        $obj['paymentMethodID'] = $paymentMethodID;

        return $obj;
    }

    /**
     * Tax identifier provided for this subscription (if applicable).
     */
    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj['taxID'] = $taxID;

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
