<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\Price\RecurringPrice\Type;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Recurring price details.
 *
 * @phpstan-type recurring_price_alias = array{
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
 *   trialPeriodDays?: int,
 * }
 */
final class RecurringPrice implements BaseModel
{
    use Model;

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
    #[Api('tax_inclusive', optional: true)]
    public ?bool $taxInclusive;

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    #[Api('trial_period_days', optional: true)]
    public ?int $trialPeriodDays;

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
    public static function from(
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
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Number of units for the payment frequency.
     * For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
     */
    public function setPaymentFrequencyCount(int $paymentFrequencyCount): self
    {
        $this->paymentFrequencyCount = $paymentFrequencyCount;

        return $this;
    }

    /**
     * The time interval for the payment frequency (e.g., day, month, year).
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
     * The payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    public function setPurchasingPowerParity(bool $purchasingPowerParity): self
    {
        $this->purchasingPowerParity = $purchasingPowerParity;

        return $this;
    }

    /**
     * Number of units for the subscription period.
     * For example, a value of `12` with a `subscription_period_interval` of `month` represents a one-year subscription.
     */
    public function setSubscriptionPeriodCount(
        int $subscriptionPeriodCount
    ): self {
        $this->subscriptionPeriodCount = $subscriptionPeriodCount;

        return $this;
    }

    /**
     * The time interval for the subscription period (e.g., day, month, year).
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
     * @param Type::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function setTaxInclusive(?bool $taxInclusive): self
    {
        $this->taxInclusive = $taxInclusive;

        return $this;
    }

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    public function setTrialPeriodDays(int $trialPeriodDays): self
    {
        $this->trialPeriodDays = $trialPeriodDays;

        return $this;
    }
}
