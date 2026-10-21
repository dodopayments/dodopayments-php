<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\AddMeterToPrice;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Usage Based price details.
 *
 * @phpstan-import-type AddMeterToPriceShape from \Dodopayments\Products\AddMeterToPrice
 *
 * @phpstan-type UsageBasedPriceShape = array{
 *   currency: Currency|value-of<Currency>,
 *   fixedPrice: int,
 *   paymentFrequencyCount: int,
 *   paymentFrequencyInterval: TimeInterval|value-of<TimeInterval>,
 *   subscriptionPeriodCount: int,
 *   subscriptionPeriodInterval: TimeInterval|value-of<TimeInterval>,
 *   type: 'usage_based_price',
 *   discount?: int|null,
 *   discountBps?: int|null,
 *   meters?: list<AddMeterToPrice|AddMeterToPriceShape>|null,
 *   purchasingPowerParity?: bool|null,
 *   taxInclusive?: bool|null,
 * }
 */
final class UsageBasedPrice implements BaseModel
{
    /** @use SdkModel<UsageBasedPriceShape> */
    use SdkModel;

    /** @var 'usage_based_price' $type */
    #[Required]
    public string $type = 'usage_based_price';

    /**
     * The currency in which the payment is made.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The fixed payment amount. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Required('fixed_price')]
    public int $fixedPrice;

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

    /** @var list<AddMeterToPrice>|null $meters */
    #[Optional(list: AddMeterToPrice::class, nullable: true)]
    public ?array $meters;

    /**
     * Opts this price in to purchasing power parity. The business must also
     * enable purchasing power parity. The discount percentage per country is
     * always business-wide. Applies to the fixed fee only, never to metered
     * usage. Defaults to `false`.
     */
    #[Optional('purchasing_power_parity')]
    public ?bool $purchasingPowerParity;

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
     *   fixedPrice: ...,
     *   paymentFrequencyCount: ...,
     *   paymentFrequencyInterval: ...,
     *   subscriptionPeriodCount: ...,
     *   subscriptionPeriodInterval: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UsageBasedPrice)
     *   ->withCurrency(...)
     *   ->withFixedPrice(...)
     *   ->withPaymentFrequencyCount(...)
     *   ->withPaymentFrequencyInterval(...)
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
     * @param list<AddMeterToPrice|AddMeterToPriceShape>|null $meters
     */
    public static function with(
        Currency|string $currency,
        int $fixedPrice,
        int $paymentFrequencyCount,
        TimeInterval|string $paymentFrequencyInterval,
        int $subscriptionPeriodCount,
        TimeInterval|string $subscriptionPeriodInterval,
        ?int $discount = null,
        ?int $discountBps = null,
        ?array $meters = null,
        ?bool $purchasingPowerParity = null,
        ?bool $taxInclusive = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['fixedPrice'] = $fixedPrice;
        $self['paymentFrequencyCount'] = $paymentFrequencyCount;
        $self['paymentFrequencyInterval'] = $paymentFrequencyInterval;
        $self['subscriptionPeriodCount'] = $subscriptionPeriodCount;
        $self['subscriptionPeriodInterval'] = $subscriptionPeriodInterval;

        null !== $discount && $self['discount'] = $discount;
        null !== $discountBps && $self['discountBps'] = $discountBps;
        null !== $meters && $self['meters'] = $meters;
        null !== $purchasingPowerParity && $self['purchasingPowerParity'] = $purchasingPowerParity;
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
     * @param 'usage_based_price' $type
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
     * @param list<AddMeterToPrice|AddMeterToPriceShape>|null $meters
     */
    public function withMeters(?array $meters): self
    {
        $self = clone $this;
        $self['meters'] = $meters;

        return $self;
    }

    /**
     * Opts this price in to purchasing power parity. The business must also
     * enable purchasing power parity. The discount percentage per country is
     * always business-wide. Applies to the fixed fee only, never to metered
     * usage. Defaults to `false`.
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
}
