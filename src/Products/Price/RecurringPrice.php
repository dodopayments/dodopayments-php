<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\Price\RecurringPrice\Type;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Recurring price details.
 *
 * @phpstan-type RecurringPriceShape = array{
 *   currency: value-of<Currency>,
 *   discount: int,
 *   payment_frequency_count: int,
 *   payment_frequency_interval: value-of<TimeInterval>,
 *   price: int,
 *   purchasing_power_parity: bool,
 *   subscription_period_count: int,
 *   subscription_period_interval: value-of<TimeInterval>,
 *   type: value-of<Type>,
 *   tax_inclusive?: bool|null,
 *   trial_period_days?: int|null,
 * }
 */
final class RecurringPrice implements BaseModel
{
    /** @use SdkModel<RecurringPriceShape> */
    use SdkModel;

    /**
     * The currency in which the payment is made.
     *
     * @var value-of<Currency> $currency
     */
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    #[Api]
    public int $discount;

    /**
     * Number of units for the payment frequency.
     * For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
     */
    #[Api]
    public int $payment_frequency_count;

    /**
     * The time interval for the payment frequency (e.g., day, month, year).
     *
     * @var value-of<TimeInterval> $payment_frequency_interval
     */
    #[Api(enum: TimeInterval::class)]
    public string $payment_frequency_interval;

    /**
     * The payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api]
    public int $price;

    /**
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    #[Api]
    public bool $purchasing_power_parity;

    /**
     * Number of units for the subscription period.
     * For example, a value of `12` with a `subscription_period_interval` of `month` represents a one-year subscription.
     */
    #[Api]
    public int $subscription_period_count;

    /**
     * The time interval for the subscription period (e.g., day, month, year).
     *
     * @var value-of<TimeInterval> $subscription_period_interval
     */
    #[Api(enum: TimeInterval::class)]
    public string $subscription_period_interval;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $tax_inclusive;

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    #[Api(optional: true)]
    public ?int $trial_period_days;

    /**
     * `new RecurringPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecurringPrice::with(
     *   currency: ...,
     *   discount: ...,
     *   payment_frequency_count: ...,
     *   payment_frequency_interval: ...,
     *   price: ...,
     *   purchasing_power_parity: ...,
     *   subscription_period_count: ...,
     *   subscription_period_interval: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecurringPrice)
     *   ->withCurrency(...)
     *   ->withDiscount(...)
     *   ->withPaymentFrequencyCount(...)
     *   ->withPaymentFrequencyInterval(...)
     *   ->withPrice(...)
     *   ->withPurchasingPowerParity(...)
     *   ->withSubscriptionPeriodCount(...)
     *   ->withSubscriptionPeriodInterval(...)
     *   ->withType(...)
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
     * @param TimeInterval|value-of<TimeInterval> $payment_frequency_interval
     * @param TimeInterval|value-of<TimeInterval> $subscription_period_interval
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Currency|string $currency,
        int $discount,
        int $payment_frequency_count,
        TimeInterval|string $payment_frequency_interval,
        int $price,
        bool $purchasing_power_parity,
        int $subscription_period_count,
        TimeInterval|string $subscription_period_interval,
        Type|string $type,
        ?bool $tax_inclusive = null,
        ?int $trial_period_days = null,
    ): self {
        $obj = new self;

        $obj['currency'] = $currency;
        $obj['discount'] = $discount;
        $obj['payment_frequency_count'] = $payment_frequency_count;
        $obj['payment_frequency_interval'] = $payment_frequency_interval;
        $obj['price'] = $price;
        $obj['purchasing_power_parity'] = $purchasing_power_parity;
        $obj['subscription_period_count'] = $subscription_period_count;
        $obj['subscription_period_interval'] = $subscription_period_interval;
        $obj['type'] = $type;

        null !== $tax_inclusive && $obj['tax_inclusive'] = $tax_inclusive;
        null !== $trial_period_days && $obj['trial_period_days'] = $trial_period_days;

        return $obj;
    }

    /**
     * The currency in which the payment is made.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    public function withDiscount(int $discount): self
    {
        $obj = clone $this;
        $obj['discount'] = $discount;

        return $obj;
    }

    /**
     * Number of units for the payment frequency.
     * For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $obj = clone $this;
        $obj['payment_frequency_count'] = $paymentFrequencyCount;

        return $obj;
    }

    /**
     * The time interval for the payment frequency (e.g., day, month, year).
     *
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
     * The payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withPrice(int $price): self
    {
        $obj = clone $this;
        $obj['price'] = $price;

        return $obj;
    }

    /**
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    public function withPurchasingPowerParity(bool $purchasingPowerParity): self
    {
        $obj = clone $this;
        $obj['purchasing_power_parity'] = $purchasingPowerParity;

        return $obj;
    }

    /**
     * Number of units for the subscription period.
     * For example, a value of `12` with a `subscription_period_interval` of `month` represents a one-year subscription.
     */
    public function withSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $obj = clone $this;
        $obj['subscription_period_count'] = $subscriptionPeriodCount;

        return $obj;
    }

    /**
     * The time interval for the subscription period (e.g., day, month, year).
     *
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
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['tax_inclusive'] = $taxInclusive;

        return $obj;
    }

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj['trial_period_days'] = $trialPeriodDays;

        return $obj;
    }
}
