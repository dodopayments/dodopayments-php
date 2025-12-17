<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\Price\RecurringPrice\Type;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Recurring price details.
 *
 * @phpstan-type RecurringPriceShape = array{
 *   currency: Currency|value-of<Currency>,
 *   discount: int,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: TimeInterval|value-of<TimeInterval>,
 *   price: int,
 *   purchasingPowerParity: bool,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: TimeInterval|value-of<TimeInterval>,
 *   type: Type|value-of<Type>,
 *   taxInclusive?: bool|null,
 *   trialPeriodDays?: int|null,
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
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    #[Required]
    public int $discount;

    /**
     * Number of units for the payment frequency.
     * For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
     */
    #[Required('payment_frequency_count')]
    public int $paymentFrequencyCount;

    /**
     * The time interval for the payment frequency (e.g., day, month, year).
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
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    #[Required('purchasing_power_parity')]
    public bool $purchasingPowerParity;

    /**
     * Number of units for the subscription period.
     * For example, a value of `12` with a `subscription_period_interval` of `month` represents a one-year subscription.
     */
    #[Required('subscription_period_count')]
    public int $subscriptionPeriodCount;

    /**
     * The time interval for the subscription period (e.g., day, month, year).
     *
     * @var value-of<TimeInterval> $subscriptionPeriodInterval
     */
    #[Required('subscription_period_interval', enum: TimeInterval::class)]
    public string $subscriptionPeriodInterval;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Optional('tax_inclusive', nullable: true)]
    public ?bool $taxInclusive;

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    #[Optional('trial_period_days')]
    public ?int $trialPeriodDays;

    /**
     * `new RecurringPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecurringPrice::with(
     *   currency: ...,
     *   discount: ...,
     *   paymentFrequencyCount: ...,
     *   paymentFrequencyInterval: ...,
     *   price: ...,
     *   purchasingPowerParity: ...,
     *   subscriptionPeriodCount: ...,
     *   subscriptionPeriodInterval: ...,
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
     * @param TimeInterval|value-of<TimeInterval> $paymentFrequencyInterval
     * @param TimeInterval|value-of<TimeInterval> $subscriptionPeriodInterval
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Currency|string $currency,
        int $discount,
        int $paymentFrequencyCount,
        TimeInterval|string $paymentFrequencyInterval,
        int $price,
        bool $purchasingPowerParity,
        int $subscriptionPeriodCount,
        TimeInterval|string $subscriptionPeriodInterval,
        Type|string $type,
        ?bool $taxInclusive = null,
        ?int $trialPeriodDays = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['discount'] = $discount;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;
        $self['paymentFrequencyInterval'] = $paymentFrequencyInterval;
        $self['price'] = $price;
        $self['purchasingPowerParity'] = $purchasingPowerParity;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;
        $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;
        $self['type'] = $type;

        null !== $taxInclusive && $self['taxInclusive'] = $taxInclusive;
        null !== $trialPeriodDays && $self['trialPeriodDays'] = $trialPeriodDays;

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
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    public function withDiscount(int $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    /**
     * Number of units for the payment frequency.
     * For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $self = clone $this;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;

        return $self;
    }

    /**
     * The time interval for the payment frequency (e.g., day, month, year).
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
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    public function withPurchasingPowerParity(bool $purchasingPowerParity): self
    {
        $self = clone $this;
        $self['purchasingPowerParity'] = $purchasingPowerParity;

        return $self;
    }

    /**
     * Number of units for the subscription period.
     * For example, a value of `12` with a `subscription_period_interval` of `month` represents a one-year subscription.
     */
    public function withSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $self = clone $this;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;

        return $self;
    }

    /**
     * The time interval for the subscription period (e.g., day, month, year).
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
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $self = clone $this;
        $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }
}
