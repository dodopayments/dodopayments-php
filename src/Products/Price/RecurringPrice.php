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
 * @phpstan-type recurring_price = array{
 *   currency: Currency::*,
 *   discount: float,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: TimeInterval::*,
 *   price: int,
 *   purchasingPowerParity: bool,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: TimeInterval::*,
 *   type: Type::*,
 *   taxInclusive?: bool|null,
 *   trialPeriodDays?: int|null,
 * }
 */
final class RecurringPrice implements BaseModel
{
    /** @use SdkModel<recurring_price> */
    use SdkModel;

    /**
     * The currency in which the payment is made.
     *
     * @var Currency::* $currency
     */
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    #[Api]
    public float $discount;

    /**
     * Number of units for the payment frequency.
     * For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
     */
    #[Api('payment_frequency_count')]
    public int $paymentFrequencyCount;

    /**
     * The time interval for the payment frequency (e.g., day, month, year).
     *
     * @var TimeInterval::* $paymentFrequencyInterval
     */
    #[Api('payment_frequency_interval', enum: TimeInterval::class)]
    public string $paymentFrequencyInterval;

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
    #[Api('purchasing_power_parity')]
    public bool $purchasingPowerParity;

    /**
     * Number of units for the subscription period.
     * For example, a value of `12` with a `subscription_period_interval` of `month` represents a one-year subscription.
     */
    #[Api('subscription_period_count')]
    public int $subscriptionPeriodCount;

    /**
     * The time interval for the subscription period (e.g., day, month, year).
     *
     * @var TimeInterval::* $subscriptionPeriodInterval
     */
    #[Api('subscription_period_interval', enum: TimeInterval::class)]
    public string $subscriptionPeriodInterval;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api('tax_inclusive', nullable: true, optional: true)]
    public ?bool $taxInclusive;

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    #[Api('trial_period_days', optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency::* $currency
     * @param TimeInterval::* $paymentFrequencyInterval
     * @param TimeInterval::* $subscriptionPeriodInterval
     * @param Type::* $type
     */
    public static function with(
        string $currency,
        float $discount,
        int $paymentFrequencyCount,
        string $paymentFrequencyInterval,
        int $price,
        bool $purchasingPowerParity,
        int $subscriptionPeriodCount,
        string $subscriptionPeriodInterval,
        string $type,
        ?bool $taxInclusive = null,
        ?int $trialPeriodDays = null,
    ): self {
        $obj = new self;

        $obj->currency = $currency;
        $obj->discount = $discount;
        $obj->paymentFrequencyCount = $paymentFrequencyCount;
        $obj->paymentFrequencyInterval = $paymentFrequencyInterval;
        $obj->price = $price;
        $obj->purchasingPowerParity = $purchasingPowerParity;
        $obj->subscriptionPeriodCount = $subscriptionPeriodCount;
        $obj->subscriptionPeriodInterval = $subscriptionPeriodInterval;
        $obj->type = $type;

        null !== $taxInclusive && $obj->taxInclusive = $taxInclusive;
        null !== $trialPeriodDays && $obj->trialPeriodDays = $trialPeriodDays;

        return $obj;
    }

    /**
     * The currency in which the payment is made.
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
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    public function withDiscount(float $discount): self
    {
        $obj = clone $this;
        $obj->discount = $discount;

        return $obj;
    }

    /**
     * Number of units for the payment frequency.
     * For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
     */
    public function withPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $obj = clone $this;
        $obj->paymentFrequencyCount = $paymentFrequencyCount;

        return $obj;
    }

    /**
     * The time interval for the payment frequency (e.g., day, month, year).
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
     * The payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withPrice(int $price): self
    {
        $obj = clone $this;
        $obj->price = $price;

        return $obj;
    }

    /**
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    public function withPurchasingPowerParity(bool $purchasingPowerParity): self
    {
        $obj = clone $this;
        $obj->purchasingPowerParity = $purchasingPowerParity;

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
        $obj->subscriptionPeriodCount = $subscriptionPeriodCount;

        return $obj;
    }

    /**
     * The time interval for the subscription period (e.g., day, month, year).
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
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj->taxInclusive = $taxInclusive;

        return $obj;
    }

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    public function withTrialPeriodDays(int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj->trialPeriodDays = $trialPeriodDays;

        return $obj;
    }
}
