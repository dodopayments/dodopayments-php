<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\Conversion\MapOf;
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
 * }
 */
final class Subscription implements BaseModel
{
    use Model;

    /**
     * Addons associated with this subscription.
     *
     * @var list<AddonCartResponseItem> $addons
     */
    #[Api(type: new ListOf(AddonCartResponseItem::class))]
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
    #[Api(type: new MapOf('string'))]
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
    #[Api('cancelled_at', optional: true)]
    public ?\DateTimeInterface $cancelledAt;

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    #[Api('discount_cycles_remaining', optional: true)]
    public ?int $discountCyclesRemaining;

    /**
     * The discount id if discount is applied.
     */
    #[Api('discount_id', optional: true)]
    public ?string $discountID;

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
     * @param list<AddonCartResponseItem> $addons
     * @param Currency::* $currency
     * @param array<string, string> $metadata
     * @param TimeInterval::* $paymentFrequencyInterval
     * @param SubscriptionStatus::* $status
     * @param TimeInterval::* $subscriptionPeriodInterval
     */
    public static function from(
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

        return $obj;
    }

    /**
     * Addons associated with this subscription.
     *
     * @param list<AddonCartResponseItem> $addons
     */
    public function setAddons(array $addons): self
    {
        $this->addons = $addons;

        return $this;
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
     * Indicates if the subscription will cancel at the next billing date.
     */
    public function setCancelAtNextBillingDate(
        bool $cancelAtNextBillingDate
    ): self {
        $this->cancelAtNextBillingDate = $cancelAtNextBillingDate;

        return $this;
    }

    /**
     * Timestamp when the subscription was created.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Currency used for the subscription payments.
     *
     * @param Currency::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Customer details associated with the subscription.
     */
    public function setCustomer(CustomerLimitedDetails $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Additional custom data associated with the subscription.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Timestamp of the next scheduled billing. Indicates the end of current billing period.
     */
    public function setNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $this->nextBillingDate = $nextBillingDate;

        return $this;
    }

    /**
     * Wether the subscription is on-demand or not.
     */
    public function setOnDemand(bool $onDemand): self
    {
        $this->onDemand = $onDemand;

        return $this;
    }

    /**
     * Number of payment frequency intervals.
     */
    public function setPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $this->paymentFrequencyCount = $paymentFrequencyCount;

        return $this;
    }

    /**
     * Time interval for payment frequency (e.g. month, year).
     *
     * @param TimeInterval::* $paymentFrequencyInterval
     */
    public function setPaymentFrequencyInterval(
        string $paymentFrequencyInterval
    ): self {
        $this->paymentFrequencyInterval = $paymentFrequencyInterval;

        return $this;
    }

    /**
     * Timestamp of the last payment. Indicates the start of current billing period.
     */
    public function setPreviousBillingDate(
        \DateTimeInterface $previousBillingDate
    ): self {
        $this->previousBillingDate = $previousBillingDate;

        return $this;
    }

    /**
     * Identifier of the product associated with this subscription.
     */
    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * Number of units/items included in the subscription.
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Amount charged before tax for each recurring payment in smallest currency unit (e.g. cents).
     */
    public function setRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $this->recurringPreTaxAmount = $recurringPreTaxAmount;

        return $this;
    }

    /**
     * Current status of the subscription.
     *
     * @param SubscriptionStatus::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function setSubscriptionID(string $subscriptionID): self
    {
        $this->subscriptionID = $subscriptionID;

        return $this;
    }

    /**
     * Number of subscription period intervals.
     */
    public function setSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $this->subscriptionPeriodCount = $subscriptionPeriodCount;

        return $this;
    }

    /**
     * Time interval for the subscription period (e.g. month, year).
     *
     * @param TimeInterval::* $subscriptionPeriodInterval
     */
    public function setSubscriptionPeriodInterval(
        string $subscriptionPeriodInterval
    ): self {
        $this->subscriptionPeriodInterval = $subscriptionPeriodInterval;

        return $this;
    }

    /**
     * Indicates if the recurring_pre_tax_amount is tax inclusive.
     */
    public function setTaxInclusive(bool $taxInclusive): self
    {
        $this->taxInclusive = $taxInclusive;

        return $this;
    }

    /**
     * Number of days in the trial period (0 if no trial).
     */
    public function setTrialPeriodDays(int $trialPeriodDays): self
    {
        $this->trialPeriodDays = $trialPeriodDays;

        return $this;
    }

    /**
     * Cancelled timestamp if the subscription is cancelled.
     */
    public function setCancelledAt(?\DateTimeInterface $cancelledAt): self
    {
        $this->cancelledAt = $cancelledAt;

        return $this;
    }

    /**
     * Number of remaining discount cycles if discount is applied.
     */
    public function setDiscountCyclesRemaining(
        ?int $discountCyclesRemaining
    ): self {
        $this->discountCyclesRemaining = $discountCyclesRemaining;

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
}
