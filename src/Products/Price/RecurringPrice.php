<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Recurring price details.
 *
 * @phpstan-type RecurringPriceShape = array{
 *   currency: Currency|value-of<Currency>,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: TimeInterval|value-of<TimeInterval>,
 *   price: int,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: TimeInterval|value-of<TimeInterval>,
 *   type: 'recurring_price',
 *   discount?: int|null,
 *   discountBps?: int|null,
 *   purchasingPowerParity?: bool|null,
 *   taxInclusive?: bool|null,
 *   trialAmount?: int|null,
 *   trialApplyDiscounts?: bool|null,
 *   trialPaymentMethodOptional?: bool|null,
 *   trialPeriodDays?: int|null,
 *   zeroAmountPaymentMethodOptional?: bool|null,
 * }
 */
final class RecurringPrice implements BaseModel
{
    /** @use SdkModel<RecurringPriceShape> */
    use SdkModel;

    /** @var 'recurring_price' $type */
    #[Required]
    public string $type = 'recurring_price';

    /**
     * The currency in which the payment is made.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Number of `payment_frequency_interval` units between two charges.
     * This field sets the billing cycle.
     * For example, `1` with a `payment_frequency_interval` of `month` charges the customer every month.
     */
    #[Required('payment_frequency_count')]
    public int $paymentFrequencyCount;

    /**
     * The time unit of the billing cycle (e.g., day, month, year).
     * Use it with `payment_frequency_count`.
     *
     * @var value-of<TimeInterval> $paymentFrequencyInterval
     */
    #[Required('payment_frequency_interval', enum: TimeInterval::class)]
    public string $paymentFrequencyInterval;

    /**
     * The payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Required]
    public int $price;

    /**
     * Number of `subscription_period_interval` units for the total duration of the subscription.
     * This field does not set the billing cycle. Use `payment_frequency_count` for the billing cycle.
     * When this period ends, the subscription expires. Dodo Payments does not start a new
     * billing cycle after the subscription expires. Dodo Payments can still retry a failed
     * payment for an earlier billing cycle.
     *
     * For a subscription that renews until the customer cancels it, set this to `20` with a
     * `subscription_period_interval` of `year`. This is the recommended value and also the maximum.
     * The subscription expires after 20 years if the customer does not cancel it before then.
     *
     * For example, a monthly plan uses a `payment_frequency_count` of `1`, a `payment_frequency_interval`
     * of `month`, and a subscription period of `20` `year`. Do not set the subscription period to
     * `1` `month` for a monthly plan: the subscription then expires after one month.
     */
    #[Required('subscription_period_count')]
    public int $subscriptionPeriodCount;

    /**
     * The time unit of the total subscription duration (e.g., day, month, year).
     * Use it with `subscription_period_count`. The recommended value is `year`, with a
     * `subscription_period_count` of `20`.
     *
     * @var value-of<TimeInterval> $subscriptionPeriodInterval
     */
    #[Required('subscription_period_interval', enum: TimeInterval::class)]
    public string $subscriptionPeriodInterval;

    /**
     * @deprecated
     *
     * Deprecated: use `discount_bps` instead.
     *
     * Discount applied to the price, represented as a percentage (0 to 100).
     * A response rounds this value to the nearest whole percent.
     * Defaults to `0`.
     */
    #[Optional]
    public ?int $discount;

    /**
     * Discount applied to the price, in basis points. 100 basis points make
     * one percent, so `1250` is a discount of 12.5%.
     *
     * Use this field for a discount with a fraction of a percent. A request
     * that sends this field ignores `discount`. A value of `0` gives no
     * discount.
     */
    #[Optional('discount_bps', nullable: true)]
    public ?int $discountBps;

    /**
     * Opts this price in to purchasing power parity. The business must also
     * enable purchasing power parity. The discount percentage per country is
     * always business-wide. Defaults to `false`.
     */
    #[Optional('purchasing_power_parity')]
    public ?bool $purchasingPowerParity;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Optional('tax_inclusive', nullable: true)]
    public ?bool $taxInclusive;

    /**
     * Amount charged today for a paid trial, in the price currency's minor units.
     * Requires `trial_period_days > 0`. Omit or null for a free trial (the default).
     */
    #[Optional('trial_amount', nullable: true)]
    public ?int $trialAmount;

    /**
     * Whether discount codes reduce the trial charge. Defaults to false. Only meaningful
     * when a paid trial is configured.
     */
    #[Optional('trial_apply_discounts', nullable: true)]
    public ?bool $trialApplyDiscounts;

    /**
     * Let a customer start a free trial with no card. Defaults to false.
     */
    #[Optional('trial_payment_method_optional')]
    public ?bool $trialPaymentMethodOptional;

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    #[Optional('trial_period_days')]
    public ?int $trialPeriodDays;

    /**
     * Let a customer start a subscription with no card, when the amount due
     * today is `0` (a native `0` price, or a 100% discount). Defaults to false.
     */
    #[Optional('zero_amount_payment_method_optional')]
    public ?bool $zeroAmountPaymentMethodOptional;

    /**
     * `new RecurringPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecurringPrice::with(
     *   currency: ...,
     *   paymentFrequencyCount: ...,
     *   paymentFrequencyInterval: ...,
     *   price: ...,
     *   subscriptionPeriodCount: ...,
     *   subscriptionPeriodInterval: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecurringPrice)
     *   ->withCurrency(...)
     *   ->withPaymentFrequencyCount(...)
     *   ->withPaymentFrequencyInterval(...)
     *   ->withPrice(...)
     *   ->withSubscriptionPeriodCount(...)
     *   ->withSubscriptionPeriodInterval(...)
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
     * @param TimeInterval|value-of<TimeInterval> $paymentFrequencyInterval
     * @param TimeInterval|value-of<TimeInterval> $subscriptionPeriodInterval
     */
    public static function with(
        Currency|string $currency,
        int $paymentFrequencyCount,
        TimeInterval|string $paymentFrequencyInterval,
        int $price,
        int $subscriptionPeriodCount,
        TimeInterval|string $subscriptionPeriodInterval,
        ?int $discount = null,
        ?int $discountBps = null,
        ?bool $purchasingPowerParity = null,
        ?bool $taxInclusive = null,
        ?int $trialAmount = null,
        ?bool $trialApplyDiscounts = null,
        ?bool $trialPaymentMethodOptional = null,
        ?int $trialPeriodDays = null,
        ?bool $zeroAmountPaymentMethodOptional = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;
        $self['paymentFrequencyInterval'] = $paymentFrequencyInterval;
        $self['price'] = $price;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;
        $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;

        null !== $discount && $self['discount'] = $discount;
        null !== $discountBps && $self['discountBps'] = $discountBps;
        null !== $purchasingPowerParity && $self['purchasingPowerParity'] = $purchasingPowerParity;
        null !== $taxInclusive && $self['taxInclusive'] = $taxInclusive;
        null !== $trialAmount && $self['trialAmount'] = $trialAmount;
        null !== $trialApplyDiscounts && $self['trialApplyDiscounts'] = $trialApplyDiscounts;
        null !== $trialPaymentMethodOptional && $self['trialPaymentMethodOptional'] = $trialPaymentMethodOptional;
        null !== $trialPeriodDays && $self['trialPeriodDays'] = $trialPeriodDays;
        null !== $zeroAmountPaymentMethodOptional && $self['zeroAmountPaymentMethodOptional'] = $zeroAmountPaymentMethodOptional;

        return $self;
    }

    /**
     * The currency in which the payment is made.
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
     * Number of `payment_frequency_interval` units between two charges.
     * This field sets the billing cycle.
     * For example, `1` with a `payment_frequency_interval` of `month` charges the customer every month.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $self = clone $this;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;

        return $self;
    }

    /**
     * The time unit of the billing cycle (e.g., day, month, year).
     * Use it with `payment_frequency_count`.
     *
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
     * The payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withPrice(int $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Number of `subscription_period_interval` units for the total duration of the subscription.
     * This field does not set the billing cycle. Use `payment_frequency_count` for the billing cycle.
     * When this period ends, the subscription expires. Dodo Payments does not start a new
     * billing cycle after the subscription expires. Dodo Payments can still retry a failed
     * payment for an earlier billing cycle.
     *
     * For a subscription that renews until the customer cancels it, set this to `20` with a
     * `subscription_period_interval` of `year`. This is the recommended value and also the maximum.
     * The subscription expires after 20 years if the customer does not cancel it before then.
     *
     * For example, a monthly plan uses a `payment_frequency_count` of `1`, a `payment_frequency_interval`
     * of `month`, and a subscription period of `20` `year`. Do not set the subscription period to
     * `1` `month` for a monthly plan: the subscription then expires after one month.
     */
    public function withSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $self = clone $this;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;

        return $self;
    }

    /**
     * The time unit of the total subscription duration (e.g., day, month, year).
     * Use it with `subscription_period_count`. The recommended value is `year`, with a
     * `subscription_period_count` of `20`.
     *
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
     * @param 'recurring_price' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Deprecated: use `discount_bps` instead.
     *
     * Discount applied to the price, represented as a percentage (0 to 100).
     * A response rounds this value to the nearest whole percent.
     * Defaults to `0`.
     */
    public function withDiscount(int $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    /**
     * Discount applied to the price, in basis points. 100 basis points make
     * one percent, so `1250` is a discount of 12.5%.
     *
     * Use this field for a discount with a fraction of a percent. A request
     * that sends this field ignores `discount`. A value of `0` gives no
     * discount.
     */
    public function withDiscountBps(?int $discountBps): self
    {
        $self = clone $this;
        $self['discountBps'] = $discountBps;

        return $self;
    }

    /**
     * Opts this price in to purchasing power parity. The business must also
     * enable purchasing power parity. The discount percentage per country is
     * always business-wide. Defaults to `false`.
     */
    public function withPurchasingPowerParity(bool $purchasingPowerParity): self
    {
        $self = clone $this;
        $self['purchasingPowerParity'] = $purchasingPowerParity;

        return $self;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    /**
     * Amount charged today for a paid trial, in the price currency's minor units.
     * Requires `trial_period_days > 0`. Omit or null for a free trial (the default).
     */
    public function withTrialAmount(?int $trialAmount): self
    {
        $self = clone $this;
        $self['trialAmount'] = $trialAmount;

        return $self;
    }

    /**
     * Whether discount codes reduce the trial charge. Defaults to false. Only meaningful
     * when a paid trial is configured.
     */
    public function withTrialApplyDiscounts(?bool $trialApplyDiscounts): self
    {
        $self = clone $this;
        $self['trialApplyDiscounts'] = $trialApplyDiscounts;

        return $self;
    }

    /**
     * Let a customer start a free trial with no card. Defaults to false.
     */
    public function withTrialPaymentMethodOptional(
        bool $trialPaymentMethodOptional
    ): self {
        $self = clone $this;
        $self['trialPaymentMethodOptional'] = $trialPaymentMethodOptional;

        return $self;
    }

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $self = clone $this;
        $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }

    /**
     * Let a customer start a subscription with no card, when the amount due
     * today is `0` (a native `0` price, or a 100% discount). Defaults to false.
     */
    public function withZeroAmountPaymentMethodOptional(
        bool $zeroAmountPaymentMethodOptional
    ): self {
        $self = clone $this;
        $self['zeroAmountPaymentMethodOptional'] = $zeroAmountPaymentMethodOptional;

        return $self;
    }
}
