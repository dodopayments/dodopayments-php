<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Subscriptions\AddonCartResponseItem;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\TimeInterval;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription\PayloadType;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-import-type AddonCartResponseItemShape from \Dodopayments\Subscriptions\AddonCartResponseItem
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Payments\BillingAddress
 * @phpstan-import-type CustomerLimitedDetailsShape from \Dodopayments\Payments\CustomerLimitedDetails
 * @phpstan-import-type MeterShape from \Dodopayments\Subscriptions\Subscription\Meter
 *
 * @phpstan-type SubscriptionShape = array{
 *   addons: list<AddonCartResponseItem|AddonCartResponseItemShape>,
 *   billing: BillingAddress|BillingAddressShape,
 *   cancelAtNextBillingDate: bool,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   customer: CustomerLimitedDetails|CustomerLimitedDetailsShape,
 *   metadata: array<string,string>,
 *   meters: list<Meter|MeterShape>,
 *   nextBillingDate: \DateTimeInterface,
 *   onDemand: bool,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: TimeInterval|value-of<TimeInterval>,
 *   previousBillingDate: \DateTimeInterface,
 *   productID: string,
 *   quantity: int,
 *   recurringPreTaxAmount: int,
 *   status: SubscriptionStatus|value-of<SubscriptionStatus>,
 *   subscriptionID: string,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: TimeInterval|value-of<TimeInterval>,
 *   taxInclusive: bool,
 *   trialPeriodDays: int,
 *   cancelledAt?: \DateTimeInterface|null,
 *   discountCyclesRemaining?: int|null,
 *   discountID?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   paymentMethodID?: string|null,
 *   taxID?: string|null,
 *   payloadType: PayloadType|value-of<PayloadType>,
 * }
 */
final class Subscription implements BaseModel
{
    /** @use SdkModel<SubscriptionShape> */
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

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /**
     * `new Subscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Subscription::with(
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
     *   payloadType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Subscription)
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
     * @param list<AddonCartResponseItem|AddonCartResponseItemShape> $addons
     * @param BillingAddress|BillingAddressShape $billing
     * @param Currency|value-of<Currency> $currency
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
     * @param array<string,string> $metadata
     * @param list<Meter|MeterShape> $meters
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
        PayloadType|string $payloadType,
        ?\DateTimeInterface $cancelledAt = null,
        ?int $discountCyclesRemaining = null,
        ?string $discountID = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $paymentMethodID = null,
        ?string $taxID = null,
    ): self {
        $self = new self;

        $self['addons'] = $addons;
        $self['billing'] = $billing;
        $self['cancelAtNextBillingDate'] = $cancelAtNextBillingDate;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customer'] = $customer;
        $self['metadata'] = $metadata;
        $self['meters'] = $meters;
        $self['nextBillingDate'] = $nextBillingDate;
        $self['onDemand'] = $onDemand;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;
        $self['paymentFrequencyInterval'] = $paymentFrequencyInterval;
        $self['previousBillingDate'] = $previousBillingDate;
        $self['productID'] = $productID;
        $self['quantity'] = $quantity;
        $self['recurringPreTaxAmount'] = $recurringPreTaxAmount;
        $self['status'] = $status;
        $self['subscriptionID'] = $subscriptionID;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;
        $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;
        $self['taxInclusive'] = $taxInclusive;
        $self['trialPeriodDays'] = $trialPeriodDays;
        $self['payloadType'] = $payloadType;

        null !== $cancelledAt && $self['cancelledAt'] = $cancelledAt;
        null !== $discountCyclesRemaining && $self['discountCyclesRemaining'] = $discountCyclesRemaining;
        null !== $discountID && $self['discountID'] = $discountID;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $paymentMethodID && $self['paymentMethodID'] = $paymentMethodID;
        null !== $taxID && $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * Addons associated with this subscription.
     *
     * @param list<AddonCartResponseItem|AddonCartResponseItemShape> $addons
     */
    public function withAddons(array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }

    /**
     * @param BillingAddress|BillingAddressShape $billing
     */
    public function withBilling(BillingAddress|array $billing): self
    {
        $self = clone $this;
        $self['billing'] = $billing;

        return $self;
    }

    /**
     * Indicates if the subscription will cancel at the next billing date.
     */
    public function withCancelAtNextBillingDate(
        bool $cancelAtNextBillingDate
    ): self {
        $self = clone $this;
        $self['cancelAtNextBillingDate'] = $cancelAtNextBillingDate;

        return $self;
    }

    /**
     * Timestamp when the subscription was created.
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
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * Additional custom data associated with the subscription.
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
     * Meters associated with this subscription (for usage-based billing).
     *
     * @param list<Meter|MeterShape> $meters
     */
    public function withMeters(array $meters): self
    {
        $self = clone $this;
        $self['meters'] = $meters;

        return $self;
    }

    /**
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    public function withNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $self = clone $this;
        $self['nextBillingDate'] = $nextBillingDate;

        return $self;
    }

    /**
     * Wether the subscription is on-demand or not.
     */
    public function withOnDemand(bool $onDemand): self
    {
        $self = clone $this;
        $self['onDemand'] = $onDemand;

        return $self;
    }

    /**
     * Number of payment frequency intervals.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $self = clone $this;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;

        return $self;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $paymentFrequencyInterval
     */
    public function withPaymentFrequencyInterval(
        TimeInterval|string $paymentFrequencyInterval
    ): self {
        $self = clone $this;
        $self['paymentFrequencyInterval'] = $paymentFrequencyInterval;

        return $self;
    }

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    public function withPreviousBillingDate(
        \DateTimeInterface $previousBillingDate
    ): self {
        $self = clone $this;
        $self['previousBillingDate'] = $previousBillingDate;

        return $self;
    }

    /**
     * Identifier of the product associated with this subscription.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Number of units/items included in the subscription.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents).
     */
    public function withRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $self = clone $this;
        $self['recurringPreTaxAmount'] = $recurringPreTaxAmount;

        return $self;
    }

    /**
     * @param SubscriptionStatus|value-of<SubscriptionStatus> $status
     */
    public function withStatus(SubscriptionStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * Number of subscription period intervals.
     */
    public function withSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $self = clone $this;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;

        return $self;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $subscriptionPeriodInterval
     */
    public function withSubscriptionPeriodInterval(
        TimeInterval|string $subscriptionPeriodInterval
    ): self {
        $self = clone $this;
        $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;

        return $self;
    }

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    /**
     * Number of days in the trial period (0 if no trial).
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $self = clone $this;
        $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    public function withCancelledAt(?\DateTimeInterface $cancelledAt): self
    {
        $self = clone $this;
        $self['cancelledAt'] = $cancelledAt;

        return $self;
    }

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    public function withDiscountCyclesRemaining(
        ?int $discountCyclesRemaining
    ): self {
        $self = clone $this;
        $self['discountCyclesRemaining'] = $discountCyclesRemaining;

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
     * Timestamp when the subscription will expire.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Saved payment method id used for recurring charges.
     */
    public function withPaymentMethodID(?string $paymentMethodID): self
    {
        $self = clone $this;
        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }

    /**
     * Tax identifier provided for this subscription (if applicable).
     */
    public function withTaxID(?string $taxID): self
    {
        $self = clone $this;
        $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }
}
