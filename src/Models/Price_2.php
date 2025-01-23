<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Price2
{
    #[SerializedName('currency')]
    public Currency $currency;

    /**
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    #[SerializedName('discount')]
    public float $discount;

    /**
	 * Number of units for the payment frequency.
For example, a value of `1` with a `payment_frequency_interval` of `month` represents monthly payments.
	 */
    #[SerializedName('payment_frequency_count')]
    public int $paymentFrequencyCount;

    #[SerializedName('payment_frequency_interval')]
    public TimeInterval $paymentFrequencyInterval;

    /**
	 * The payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
For example, to charge $1.00, pass `100`.
	 */
    #[SerializedName('price')]
    public int $price;

    /**
	 * Indicates if purchasing power parity adjustments are applied to the price.
Purchasing power parity feature is not available as of now
	 */
    #[SerializedName('purchasing_power_parity')]
    public bool $purchasingPowerParity;

    /**
	 * Number of units for the subscription period.
For example, a value of `12` with a `subscription_period_interval` of `month` represents a one-year subscription.
	 */
    #[SerializedName('subscription_period_count')]
    public int $subscriptionPeriodCount;

    #[SerializedName('subscription_period_interval')]
    public TimeInterval $subscriptionPeriodInterval;

    /**
     * Indicates if the price is tax inclusive
     */
    #[SerializedName('tax_inclusive')]
    public ?bool $taxInclusive;

    /**
     * Number of days for the trial period. A value of `0` indicates no trial period.
     */
    #[SerializedName('trial_period_days')]
    public ?int $trialPeriodDays;

    #[SerializedName('type')]
    public Price2Type $type;

    public function __construct(
        Currency $currency,
        float $discount,
        int $paymentFrequencyCount,
        TimeInterval $paymentFrequencyInterval,
        int $price,
        bool $purchasingPowerParity,
        int $subscriptionPeriodCount,
        TimeInterval $subscriptionPeriodInterval,
        ?bool $taxInclusive = null,
        ?int $trialPeriodDays = null,
        Price2Type $type
    ) {
        $this->currency = $currency;
        $this->discount = $discount;
        $this->paymentFrequencyCount = $paymentFrequencyCount;
        $this->paymentFrequencyInterval = $paymentFrequencyInterval;
        $this->price = $price;
        $this->purchasingPowerParity = $purchasingPowerParity;
        $this->subscriptionPeriodCount = $subscriptionPeriodCount;
        $this->subscriptionPeriodInterval = $subscriptionPeriodInterval;
        $this->taxInclusive = $taxInclusive;
        $this->trialPeriodDays = $trialPeriodDays;
        $this->type = $type;
    }
}
