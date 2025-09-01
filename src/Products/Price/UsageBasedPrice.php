<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\AddMeterToPrice;
use Dodopayments\Products\Price\UsageBasedPrice\Type;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Usage Based price details.
 *
 * @phpstan-type usage_based_price = array{
 *   currency: Currency::*,
 *   discount: int,
 *   fixedPrice: int,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: TimeInterval::*,
 *   purchasingPowerParity: bool,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: TimeInterval::*,
 *   type: Type::*,
 *   meters?: list<AddMeterToPrice>|null,
 *   taxInclusive?: bool|null,
 * }
 */
final class UsageBasedPrice implements BaseModel
{
    /** @use SdkModel<usage_based_price> */
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
    public int $discount;

    /**
     * The fixed payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api('fixed_price')]
    public int $fixedPrice;

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

    /** @var list<AddMeterToPrice>|null $meters */
    #[Api(list: AddMeterToPrice::class, nullable: true, optional: true)]
    public ?array $meters;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api('tax_inclusive', nullable: true, optional: true)]
    public ?bool $taxInclusive;

    /**
     * `new UsageBasedPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageBasedPrice::with(
     *   currency: ...,
     *   discount: ...,
     *   fixedPrice: ...,
     *   paymentFrequencyCount: ...,
     *   paymentFrequencyInterval: ...,
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
     * (new UsageBasedPrice)
     *   ->withCurrency(...)
     *   ->withDiscount(...)
     *   ->withFixedPrice(...)
     *   ->withPaymentFrequencyCount(...)
     *   ->withPaymentFrequencyInterval(...)
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
     * @param Currency::* $currency
     * @param TimeInterval::* $paymentFrequencyInterval
     * @param TimeInterval::* $subscriptionPeriodInterval
     * @param Type::* $type
     * @param list<AddMeterToPrice>|null $meters
     */
    public static function with(
        string $currency,
        int $discount,
        int $fixedPrice,
        int $paymentFrequencyCount,
        string $paymentFrequencyInterval,
        bool $purchasingPowerParity,
        int $subscriptionPeriodCount,
        string $subscriptionPeriodInterval,
        string $type,
        ?array $meters = null,
        ?bool $taxInclusive = null,
    ): self {
        $obj = new self;

        $obj->currency = $currency;
        $obj->discount = $discount;
        $obj->fixedPrice = $fixedPrice;
        $obj->paymentFrequencyCount = $paymentFrequencyCount;
        $obj->paymentFrequencyInterval = $paymentFrequencyInterval;
        $obj->purchasingPowerParity = $purchasingPowerParity;
        $obj->subscriptionPeriodCount = $subscriptionPeriodCount;
        $obj->subscriptionPeriodInterval = $subscriptionPeriodInterval;
        $obj->type = $type;

        null !== $meters && $obj->meters = $meters;
        null !== $taxInclusive && $obj->taxInclusive = $taxInclusive;

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
    public function withDiscount(int $discount): self
    {
        $obj = clone $this;
        $obj->discount = $discount;

        return $obj;
    }

    /**
     * The fixed payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withFixedPrice(int $fixedPrice): self
    {
        $obj = clone $this;
        $obj->fixedPrice = $fixedPrice;

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
     * @param list<AddMeterToPrice>|null $meters
     */
    public function withMeters(?array $meters): self
    {
        $obj = clone $this;
        $obj->meters = $meters;

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
}
