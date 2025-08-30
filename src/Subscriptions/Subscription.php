<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-type subscription_alias = array{
 *   addons: list<AddonCartResponseItem>,
 *   billing: BillingAddress,
 *   cancelAtNextBillingDate: bool,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency::*,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string, string>,
 *   nextBillingDate: \DateTimeInterface,
 *   onDemand: bool,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: TimeInterval::*,
 *   previousBillingDate: \DateTimeInterface,
 *   productID: string,
 *   quantity: int,
 *   recurringPreTaxAmount: int,
 *   status: SubscriptionStatus::*,
 *   subscriptionID: string,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: TimeInterval::*,
 *   taxInclusive: bool,
 *   trialPeriodDays: int,
 *   cancelledAt?: \DateTimeInterface|null,
 *   discountCyclesRemaining?: int|null,
 *   discountID?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class Subscription implements BaseModel
{
    /** @use SdkModel<subscription_alias> */
    use SdkModel;

    /**
     * Addons associated with this subscription.
     *
     * @var list<AddonCartResponseItem> $addons
     */
    #[Api(list: AddonCartResponseItem::class)]
    public array $addons;

    /**
     * Billing address details for payments.
     */
    #[Api]
    public BillingAddress $billing;

    /**
     * Indicates if the subscription will cancel at the next billing date.
     */
    #[Api('cancel_at_next_billing_date')]
    public bool $cancelAtNextBillingDate;

    /**
     * Timestamp when the subscription was created.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Currency used for the subscription payments.
     *
     * @var Currency::* $currency
     */
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * Customer details associated with the subscription.
     */
    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * Additional custom data associated with the subscription.
     *
     * @var array<string, string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    #[Api('next_billing_date')]
    public \DateTimeInterface $nextBillingDate;

    /**
     * Wether the subscription is on-demand or not.
     */
    #[Api('on_demand')]
    public bool $onDemand;

    /**
     * Number of payment frequency intervals.
     */
    #[Api('payment_frequency_count')]
    public int $paymentFrequencyCount;

    /**
     * Time interval for payment frequency (e.g. month, year).
     *
     * @var TimeInterval::* $paymentFrequencyInterval
     */
    #[Api('payment_frequency_interval', enum: TimeInterval::class)]
    public string $paymentFrequencyInterval;

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    #[Api('previous_billing_date')]
    public \DateTimeInterface $previousBillingDate;

    /**
     * Identifier of the product associated with this subscription.
     */
    #[Api('product_id')]
    public string $productID;

    /**
     * Number of units/items included in the subscription.
     */
    #[Api]
    public int $quantity;

    /**
     * Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents).
     */
    #[Api('recurring_pre_tax_amount')]
    public int $recurringPreTaxAmount;

    /**
     * Current status of the subscription.
     *
     * @var SubscriptionStatus::* $status
     */
    #[Api(enum: SubscriptionStatus::class)]
    public string $status;

    /**
     * Unique identifier for the subscription.
     */
    #[Api('subscription_id')]
    public string $subscriptionID;

    /**
     * Number of subscription period intervals.
     */
    #[Api('subscription_period_count')]
    public int $subscriptionPeriodCount;

    /**
     * Time interval for the subscription period (e.g. month, year).
     *
     * @var TimeInterval::* $subscriptionPeriodInterval
     */
    #[Api('subscription_period_interval', enum: TimeInterval::class)]
    public string $subscriptionPeriodInterval;

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    #[Api('tax_inclusive')]
    public bool $taxInclusive;

    /**
     * Number of days in the trial period (0 if no trial).
     */
    #[Api('trial_period_days')]
    public int $trialPeriodDays;

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    #[Api('cancelled_at', nullable: true, optional: true)]
    public ?\DateTimeInterface $cancelledAt;

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    #[Api('discount_cycles_remaining', nullable: true, optional: true)]
    public ?int $discountCyclesRemaining;

    /**
     * The discount id if discount is applied.
     */
    #[Api('discount_id', nullable: true, optional: true)]
    public ?string $discountID;

    /**
     * Timestamp when the subscription will expire.
     */
    #[Api('expires_at', nullable: true, optional: true)]
    public ?\DateTimeInterface $expiresAt;

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
     * (new Subscription)
     *   ->withAddons(...)
     *   ->withBilling(...)
     *   ->withCancelAtNextBillingDate(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withMetadata(...)
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
     * @param Currency::* $currency
     * @param array<string, string> $metadata
     * @param TimeInterval::* $paymentFrequencyInterval
     * @param SubscriptionStatus::* $status
     * @param TimeInterval::* $subscriptionPeriodInterval
     */
    public static function with(
        array $addons,
        BillingAddress $billing,
        bool $cancelAtNextBillingDate,
        \DateTimeInterface $createdAt,
        string $currency,
        CustomerLimitedDetails $customer,
        array $metadata,
        \DateTimeInterface $nextBillingDate,
        bool $onDemand,
        int $paymentFrequencyCount,
        string $paymentFrequencyInterval,
        \DateTimeInterface $previousBillingDate,
        string $productID,
        int $quantity,
        int $recurringPreTaxAmount,
        string $status,
        string $subscriptionID,
        int $subscriptionPeriodCount,
        string $subscriptionPeriodInterval,
        bool $taxInclusive,
        int $trialPeriodDays,
        ?\DateTimeInterface $cancelledAt = null,
        ?int $discountCyclesRemaining = null,
        ?string $discountID = null,
        ?\DateTimeInterface $expiresAt = null,
    ): self {
        $obj = new self;

        $obj->addons = $addons;
        $obj->billing = $billing;
        $obj->cancelAtNextBillingDate = $cancelAtNextBillingDate;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency;
        $obj->customer = $customer;
        $obj->metadata = $metadata;
        $obj->nextBillingDate = $nextBillingDate;
        $obj->onDemand = $onDemand;
        $obj->paymentFrequencyCount = $paymentFrequencyCount;
        $obj->paymentFrequencyInterval = $paymentFrequencyInterval;
        $obj->previousBillingDate = $previousBillingDate;
        $obj->productID = $productID;
        $obj->quantity = $quantity;
        $obj->recurringPreTaxAmount = $recurringPreTaxAmount;
        $obj->status = $status;
        $obj->subscriptionID = $subscriptionID;
        $obj->subscriptionPeriodCount = $subscriptionPeriodCount;
        $obj->subscriptionPeriodInterval = $subscriptionPeriodInterval;
        $obj->taxInclusive = $taxInclusive;
        $obj->trialPeriodDays = $trialPeriodDays;

        null !== $cancelledAt && $obj->cancelledAt = $cancelledAt;
        null !== $discountCyclesRemaining && $obj->discountCyclesRemaining = $discountCyclesRemaining;
        null !== $discountID && $obj->discountID = $discountID;
        null !== $expiresAt && $obj->expiresAt = $expiresAt;

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
     * Indicates if the subscription will cancel at the next billing date.
     */
    public function withCancelAtNextBillingDate(
        bool $cancelAtNextBillingDate
    ): self {
        $obj = clone $this;
        $obj->cancelAtNextBillingDate = $cancelAtNextBillingDate;

        return $obj;
    }

    /**
     * Timestamp when the subscription was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * Currency used for the subscription payments.
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
     * Customer details associated with the subscription.
     */
    public function withCustomer(CustomerLimitedDetails $customer): self
    {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * Additional custom data associated with the subscription.
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
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    public function withNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj->nextBillingDate = $nextBillingDate;

        return $obj;
    }

    /**
     * Wether the subscription is on-demand or not.
     */
    public function withOnDemand(bool $onDemand): self
    {
        $obj = clone $this;
        $obj->onDemand = $onDemand;

        return $obj;
    }

    /**
     * Number of payment frequency intervals.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $obj = clone $this;
        $obj->paymentFrequencyCount = $paymentFrequencyCount;

        return $obj;
    }

    /**
     * Time interval for payment frequency (e.g. month, year).
     *
     * @param TimeInterval::* $paymentFrequencyInterval
     */
    public function withPaymentFrequencyInterval(
        string $paymentFrequencyInterval
    ): self {
        $obj = clone $this;
        $obj->paymentFrequencyInterval = $paymentFrequencyInterval;

        return $obj;
    }

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    public function withPreviousBillingDate(
        \DateTimeInterface $previousBillingDate
    ): self {
        $obj = clone $this;
        $obj->previousBillingDate = $previousBillingDate;

        return $obj;
    }

    /**
     * Identifier of the product associated with this subscription.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

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
        $obj->recurringPreTaxAmount = $recurringPreTaxAmount;

        return $obj;
    }

    /**
     * Current status of the subscription.
     *
     * @param SubscriptionStatus::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $obj = clone $this;
        $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    /**
     * Number of subscription period intervals.
     */
    public function withSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $obj = clone $this;
        $obj->subscriptionPeriodCount = $subscriptionPeriodCount;

        return $obj;
    }

    /**
     * Time interval for the subscription period (e.g. month, year).
     *
     * @param TimeInterval::* $subscriptionPeriodInterval
     */
    public function withSubscriptionPeriodInterval(
        string $subscriptionPeriodInterval
    ): self {
        $obj = clone $this;
        $obj->subscriptionPeriodInterval = $subscriptionPeriodInterval;

        return $obj;
    }

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj->taxInclusive = $taxInclusive;

        return $obj;
    }

    /**
     * Number of days in the trial period (0 if no trial).
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj->trialPeriodDays = $trialPeriodDays;

        return $obj;
    }

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    public function withCancelledAt(?\DateTimeInterface $cancelledAt): self
    {
        $obj = clone $this;
        $obj->cancelledAt = $cancelledAt;

        return $obj;
    }

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    public function withDiscountCyclesRemaining(
        ?int $discountCyclesRemaining
    ): self {
        $obj = clone $this;
        $obj->discountCyclesRemaining = $discountCyclesRemaining;

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
     * Timestamp when the subscription will expire.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj->expiresAt = $expiresAt;

        return $obj;
    }
}
