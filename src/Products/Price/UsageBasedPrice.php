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
 * @phpstan-type UsageBasedPriceShape = array{
 *   currency: value-of<Currency>,
 *   discount: int,
 *   fixed_price: int,
 *   payment_frequency_count: int,
 *   payment_frequency_interval: value-of<TimeInterval>,
 *   purchasing_power_parity: bool,
 *   subscription_period_count: int,
 *   subscription_period_interval: value-of<TimeInterval>,
 *   type: value-of<Type>,
 *   meters?: list<AddMeterToPrice>|null,
 *   tax_inclusive?: bool|null,
 * }
 */
final class UsageBasedPrice implements BaseModel
{
    /** @use SdkModel<UsageBasedPriceShape> */
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
     * The fixed payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api]
    public int $fixed_price;

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

    /** @var list<AddMeterToPrice>|null $meters */
    #[Api(list: AddMeterToPrice::class, nullable: true, optional: true)]
    public ?array $meters;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $tax_inclusive;

    /**
     * `new UsageBasedPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageBasedPrice::with(
     *   currency: ...,
     *   discount: ...,
     *   fixed_price: ...,
     *   payment_frequency_count: ...,
     *   payment_frequency_interval: ...,
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
     * @param Currency|value-of<Currency> $currency
     * @param TimeInterval|value-of<TimeInterval> $payment_frequency_interval
     * @param TimeInterval|value-of<TimeInterval> $subscription_period_interval
     * @param Type|value-of<Type> $type
     * @param list<AddMeterToPrice|array{
     *   meter_id: string,
     *   price_per_unit: string,
     *   description?: string|null,
     *   free_threshold?: int|null,
     *   measurement_unit?: string|null,
     *   name?: string|null,
     * }>|null $meters
     */
    public static function with(
        Currency|string $currency,
        int $discount,
        int $fixed_price,
        int $payment_frequency_count,
        TimeInterval|string $payment_frequency_interval,
        bool $purchasing_power_parity,
        int $subscription_period_count,
        TimeInterval|string $subscription_period_interval,
        Type|string $type,
        ?array $meters = null,
        ?bool $tax_inclusive = null,
    ): self {
        $obj = new self;

        $obj['currency'] = $currency;
        $obj['discount'] = $discount;
        $obj['fixed_price'] = $fixed_price;
        $obj['payment_frequency_count'] = $payment_frequency_count;
        $obj['payment_frequency_interval'] = $payment_frequency_interval;
        $obj['purchasing_power_parity'] = $purchasing_power_parity;
        $obj['subscription_period_count'] = $subscription_period_count;
        $obj['subscription_period_interval'] = $subscription_period_interval;
        $obj['type'] = $type;

        null !== $meters && $obj['meters'] = $meters;
        null !== $tax_inclusive && $obj['tax_inclusive'] = $tax_inclusive;

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
     * The fixed payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withFixedPrice(int $fixedPrice): self
    {
        $obj = clone $this;
        $obj['fixed_price'] = $fixedPrice;

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
     * @param list<AddMeterToPrice|array{
     *   meter_id: string,
     *   price_per_unit: string,
     *   description?: string|null,
     *   free_threshold?: int|null,
     *   measurement_unit?: string|null,
     *   name?: string|null,
     * }>|null $meters
     */
    public function withMeters(?array $meters): self
    {
        $obj = clone $this;
        $obj['meters'] = $meters;

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
}
