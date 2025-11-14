<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionRenewedWebhookEvent;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Subscriptions\AddonCartResponseItem;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\TimeInterval;
use Dodopayments\Webhooks\SubscriptionRenewedWebhookEvent\Data\PayloadType;

/**
 * Event-specific data.
 *
 * @phpstan-type DataShape = array{
 *   addons: list<AddonCartResponseItem>,
 *   billing: BillingAddress,
 *   cancel_at_next_billing_date: bool,
 *   created_at: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string,string>,
 *   meters: list<Meter>,
 *   next_billing_date: \DateTimeInterface,
 *   on_demand: bool,
 *   payment_frequency_count: int,
 *   payment_frequency_interval: value-of<TimeInterval>,
 *   previous_billing_date: \DateTimeInterface,
 *   product_id: string,
 *   quantity: int,
 *   recurring_pre_tax_amount: int,
 *   status: value-of<SubscriptionStatus>,
 *   subscription_id: string,
 *   subscription_period_count: int,
 *   subscription_period_interval: value-of<TimeInterval>,
 *   tax_inclusive: bool,
 *   trial_period_days: int,
 *   cancelled_at?: \DateTimeInterface|null,
 *   discount_cycles_remaining?: int|null,
 *   discount_id?: string|null,
 *   expires_at?: \DateTimeInterface|null,
 *   payment_method_id?: string|null,
 *   tax_id?: string|null,
 *   payload_type?: value-of<PayloadType>|null,
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
    #[Api(list: AddonCartResponseItem::class)]
    public array $addons;

    #[Api]
    public BillingAddress $billing;

    /**
     * Indicates if the subscription will cancel at the next billing date.
     */
    #[Api]
    public bool $cancel_at_next_billing_date;

    /**
     * Timestamp when the subscription was created.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /** @var value-of<Currency> $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * Additional custom data associated with the subscription.
     *
     * @var array<string,string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * Meters associated with this subscription (for usage-based billing).
     *
     * @var list<Meter> $meters
     */
    #[Api(list: Meter::class)]
    public array $meters;

    /**
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    #[Api]
    public \DateTimeInterface $next_billing_date;

    /**
     * Wether the subscription is on-demand or not.
     */
    #[Api]
    public bool $on_demand;

    /**
     * Number of payment frequency intervals.
     */
    #[Api]
    public int $payment_frequency_count;

    /** @var value-of<TimeInterval> $payment_frequency_interval */
    #[Api(enum: TimeInterval::class)]
    public string $payment_frequency_interval;

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    #[Api]
    public \DateTimeInterface $previous_billing_date;

    /**
     * Identifier of the product associated with this subscription.
     */
    #[Api]
    public string $product_id;

    /**
     * Number of units/items included in the subscription.
     */
    #[Api]
    public int $quantity;

    /**
     * Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents).
     */
    #[Api]
    public int $recurring_pre_tax_amount;

    /** @var value-of<SubscriptionStatus> $status */
    #[Api(enum: SubscriptionStatus::class)]
    public string $status;

    /**
     * Unique identifier for the subscription.
     */
    #[Api]
    public string $subscription_id;

    /**
     * Number of subscription period intervals.
     */
    #[Api]
    public int $subscription_period_count;

    /** @var value-of<TimeInterval> $subscription_period_interval */
    #[Api(enum: TimeInterval::class)]
    public string $subscription_period_interval;

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    #[Api]
    public bool $tax_inclusive;

    /**
     * Number of days in the trial period (0 if no trial).
     */
    #[Api]
    public int $trial_period_days;

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $cancelled_at;

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $discount_cycles_remaining;

    /**
     * The discount id if discount is applied.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $discount_id;

    /**
     * Timestamp when the subscription will expire.
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $expires_at;

    /**
     * Saved payment method id used for recurring charges.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $payment_method_id;

    /**
     * Tax identifier provided for this subscription (if applicable).
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tax_id;

    /**
     * The type of payload in the data field.
     *
     * @var value-of<PayloadType>|null $payload_type
     */
    #[Api(enum: PayloadType::class, optional: true)]
    public ?string $payload_type;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   addons: ...,
     *   billing: ...,
     *   cancel_at_next_billing_date: ...,
     *   created_at: ...,
     *   currency: ...,
     *   customer: ...,
     *   metadata: ...,
     *   meters: ...,
     *   next_billing_date: ...,
     *   on_demand: ...,
     *   payment_frequency_count: ...,
     *   payment_frequency_interval: ...,
     *   previous_billing_date: ...,
     *   product_id: ...,
     *   quantity: ...,
     *   recurring_pre_tax_amount: ...,
     *   status: ...,
     *   subscription_id: ...,
     *   subscription_period_count: ...,
     *   subscription_period_interval: ...,
     *   tax_inclusive: ...,
     *   trial_period_days: ...,
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
     * @param list<AddonCartResponseItem> $addons
     * @param Currency|value-of<Currency> $currency
     * @param array<string,string> $metadata
     * @param list<Meter> $meters
     * @param TimeInterval|value-of<TimeInterval> $payment_frequency_interval
     * @param SubscriptionStatus|value-of<SubscriptionStatus> $status
     * @param TimeInterval|value-of<TimeInterval> $subscription_period_interval
     * @param PayloadType|value-of<PayloadType> $payload_type
     */
    public static function with(
        array $addons,
        BillingAddress $billing,
        bool $cancel_at_next_billing_date,
        \DateTimeInterface $created_at,
        Currency|string $currency,
        CustomerLimitedDetails $customer,
        array $metadata,
        array $meters,
        \DateTimeInterface $next_billing_date,
        bool $on_demand,
        int $payment_frequency_count,
        TimeInterval|string $payment_frequency_interval,
        \DateTimeInterface $previous_billing_date,
        string $product_id,
        int $quantity,
        int $recurring_pre_tax_amount,
        SubscriptionStatus|string $status,
        string $subscription_id,
        int $subscription_period_count,
        TimeInterval|string $subscription_period_interval,
        bool $tax_inclusive,
        int $trial_period_days,
        ?\DateTimeInterface $cancelled_at = null,
        ?int $discount_cycles_remaining = null,
        ?string $discount_id = null,
        ?\DateTimeInterface $expires_at = null,
        ?string $payment_method_id = null,
        ?string $tax_id = null,
        PayloadType|string|null $payload_type = null,
    ): self {
        $obj = new self;

        $obj->addons = $addons;
        $obj->billing = $billing;
        $obj->cancel_at_next_billing_date = $cancel_at_next_billing_date;
        $obj->created_at = $created_at;
        $obj['currency'] = $currency;
        $obj->customer = $customer;
        $obj->metadata = $metadata;
        $obj->meters = $meters;
        $obj->next_billing_date = $next_billing_date;
        $obj->on_demand = $on_demand;
        $obj->payment_frequency_count = $payment_frequency_count;
        $obj['payment_frequency_interval'] = $payment_frequency_interval;
        $obj->previous_billing_date = $previous_billing_date;
        $obj->product_id = $product_id;
        $obj->quantity = $quantity;
        $obj->recurring_pre_tax_amount = $recurring_pre_tax_amount;
        $obj['status'] = $status;
        $obj->subscription_id = $subscription_id;
        $obj->subscription_period_count = $subscription_period_count;
        $obj['subscription_period_interval'] = $subscription_period_interval;
        $obj->tax_inclusive = $tax_inclusive;
        $obj->trial_period_days = $trial_period_days;

        null !== $cancelled_at && $obj->cancelled_at = $cancelled_at;
        null !== $discount_cycles_remaining && $obj->discount_cycles_remaining = $discount_cycles_remaining;
        null !== $discount_id && $obj->discount_id = $discount_id;
        null !== $expires_at && $obj->expires_at = $expires_at;
        null !== $payment_method_id && $obj->payment_method_id = $payment_method_id;
        null !== $tax_id && $obj->tax_id = $tax_id;
        null !== $payload_type && $obj['payload_type'] = $payload_type;

        return $obj;
    }

    /**
     * Addons associated with this subscription.
     *
     * @param list<AddonCartResponseItem> $addons
     */
    public function withAddons(array $addons): self
    {
        $obj = clone $this;
        $obj->addons = $addons;

        return $obj;
    }

    public function withBilling(BillingAddress $billing): self
    {
        $obj = clone $this;
        $obj->billing = $billing;

        return $obj;
    }

    /**
     * Indicates if the subscription will cancel at the next billing date.
     */
    public function withCancelAtNextBillingDate(
        bool $cancelAtNextBillingDate
    ): self {
        $obj = clone $this;
        $obj->cancel_at_next_billing_date = $cancelAtNextBillingDate;

        return $obj;
    }

    /**
     * Timestamp when the subscription was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->created_at = $createdAt;

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
     * Additional custom data associated with the subscription.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Meters associated with this subscription (for usage-based billing).
     *
     * @param list<Meter> $meters
     */
    public function withMeters(array $meters): self
    {
        $obj = clone $this;
        $obj->meters = $meters;

        return $obj;
    }

    /**
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    public function withNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj->next_billing_date = $nextBillingDate;

        return $obj;
    }

    /**
     * Wether the subscription is on-demand or not.
     */
    public function withOnDemand(bool $onDemand): self
    {
        $obj = clone $this;
        $obj->on_demand = $onDemand;

        return $obj;
    }

    /**
     * Number of payment frequency intervals.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $obj = clone $this;
        $obj->payment_frequency_count = $paymentFrequencyCount;

        return $obj;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $paymentFrequencyInterval
     */
    public function withPaymentFrequencyInterval(
        TimeInterval|string $paymentFrequencyInterval
    ): self {
        $obj = clone $this;
        $obj['payment_frequency_interval'] = $paymentFrequencyInterval;

        return $obj;
    }

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    public function withPreviousBillingDate(
        \DateTimeInterface $previousBillingDate
    ): self {
        $obj = clone $this;
        $obj->previous_billing_date = $previousBillingDate;

        return $obj;
    }

    /**
     * Identifier of the product associated with this subscription.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->product_id = $productID;

        return $obj;
    }

    /**
     * Number of units/items included in the subscription.
     */
    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }

    /**
     * Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents).
     */
    public function withRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $obj = clone $this;
        $obj->recurring_pre_tax_amount = $recurringPreTaxAmount;

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
        $obj->subscription_id = $subscriptionID;

        return $obj;
    }

    /**
     * Number of subscription period intervals.
     */
    public function withSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $obj = clone $this;
        $obj->subscription_period_count = $subscriptionPeriodCount;

        return $obj;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $subscriptionPeriodInterval
     */
    public function withSubscriptionPeriodInterval(
        TimeInterval|string $subscriptionPeriodInterval
    ): self {
        $obj = clone $this;
        $obj['subscription_period_interval'] = $subscriptionPeriodInterval;

        return $obj;
    }

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj->tax_inclusive = $taxInclusive;

        return $obj;
    }

    /**
     * Number of days in the trial period (0 if no trial).
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj->trial_period_days = $trialPeriodDays;

        return $obj;
    }

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    public function withCancelledAt(?\DateTimeInterface $cancelledAt): self
    {
        $obj = clone $this;
        $obj->cancelled_at = $cancelledAt;

        return $obj;
    }

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    public function withDiscountCyclesRemaining(
        ?int $discountCyclesRemaining
    ): self {
        $obj = clone $this;
        $obj->discount_cycles_remaining = $discountCyclesRemaining;

        return $obj;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $obj = clone $this;
        $obj->discount_id = $discountID;

        return $obj;
    }

    /**
     * Timestamp when the subscription will expire.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj->expires_at = $expiresAt;

        return $obj;
    }

    /**
     * Saved payment method id used for recurring charges.
     */
    public function withPaymentMethodID(?string $paymentMethodID): self
    {
        $obj = clone $this;
        $obj->payment_method_id = $paymentMethodID;

        return $obj;
    }

    /**
     * Tax identifier provided for this subscription (if applicable).
     */
    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj->tax_id = $taxID;

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
        $obj['payload_type'] = $payloadType;

        return $obj;
    }
}
