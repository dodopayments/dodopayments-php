<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
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
 *   fixedPrice: int,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: value-of<TimeInterval>,
 *   purchasingPowerParity: bool,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: value-of<TimeInterval>,
 *   type: value-of<Type>,
 *   meters?: list<AddMeterToPrice>|null,
 *   taxInclusive?: bool|null,
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
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Discount applied to the price, represented as a percentage (0 to 100).
     */
    #[Required]
    public int $discount;

    /**
     * The fixed payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Required('fixed_price')]
    public int $fixedPrice;

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

    /** @var list<AddMeterToPrice>|null $meters */
    #[Optional(list: AddMeterToPrice::class, nullable: true)]
    public ?array $meters;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Optional('tax_inclusive', nullable: true)]
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
     * @param Currency|value-of<Currency> $currency
     * @param TimeInterval|value-of<TimeInterval> $paymentFrequencyInterval
     * @param TimeInterval|value-of<TimeInterval> $subscriptionPeriodInterval
     * @param Type|value-of<Type> $type
     * @param list<AddMeterToPrice|array{
     *   meterID: string,
     *   pricePerUnit: string,
     *   description?: string|null,
     *   freeThreshold?: int|null,
     *   measurementUnit?: string|null,
     *   name?: string|null,
     * }>|null $meters
     */
    public static function with(
        Currency|string $currency,
        int $discount,
        int $fixedPrice,
        int $paymentFrequencyCount,
        TimeInterval|string $paymentFrequencyInterval,
        bool $purchasingPowerParity,
        int $subscriptionPeriodCount,
        TimeInterval|string $subscriptionPeriodInterval,
        Type|string $type,
        ?array $meters = null,
        ?bool $taxInclusive = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['discount'] = $discount;
        $self['fixedPrice'] = $fixedPrice;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;
        $self['paymentFrequencyInterval'] = $paymentFrequencyInterval;
        $self['purchasingPowerParity'] = $purchasingPowerParity;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;
        $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;
        $self['type'] = $type;

        null !== $meters && $self['meters'] = $meters;
        null !== $taxInclusive && $self['taxInclusive'] = $taxInclusive;

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
     * The fixed payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withFixedPrice(int $fixedPrice): self
    {
        $self = clone $this;
        $self['fixedPrice'] = $fixedPrice;

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
     * @param list<AddMeterToPrice|array{
     *   meterID: string,
     *   pricePerUnit: string,
     *   description?: string|null,
     *   freeThreshold?: int|null,
     *   measurementUnit?: string|null,
     *   name?: string|null,
     * }>|null $meters
     */
    public function withMeters(?array $meters): self
    {
        $self = clone $this;
        $self['meters'] = $meters;

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
}
