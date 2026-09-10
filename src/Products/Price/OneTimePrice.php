<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * One-time price details.
 *
 * @phpstan-type OneTimePriceShape = array{
 *   currency: Currency|value-of<Currency>,
 *   price: int,
 *   type: 'one_time_price',
 *   discount?: int|null,
 *   discountBps?: int|null,
 *   payWhatYouWant?: bool|null,
 *   purchasingPowerParity?: bool|null,
 *   suggestedPrice?: int|null,
 *   taxInclusive?: bool|null,
 * }
 */
final class OneTimePrice implements BaseModel
{
    /** @use SdkModel<OneTimePriceShape> */
    use SdkModel;

    /** @var 'one_time_price' $type */
    #[Required]
    public string $type = 'one_time_price';

    /**
     * The currency in which the payment is made.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The payment amount, in the smallest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     *
     * If [`pay_what_you_want`](Self::pay_what_you_want) is set to `true`, this field represents
     * the **minimum** amount the customer must pay.
     */
    #[Required]
    public int $price;

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
     * Indicates whether the customer can pay any amount they choose.
     * If set to `true`, the [`price`](Self::price) field is the minimum amount.
     */
    #[Optional('pay_what_you_want')]
    public ?bool $payWhatYouWant;

    /**
     * Opts this price in to purchasing power parity. The business must also
     * enable purchasing power parity. The discount percentage per country is
     * always business-wide. Defaults to `false`.
     */
    #[Optional('purchasing_power_parity')]
    public ?bool $purchasingPowerParity;

    /**
     * A suggested price for the user to pay. This value is only considered if
     * [`pay_what_you_want`](Self::pay_what_you_want) is `true`. Otherwise, it is ignored.
     */
    #[Optional('suggested_price', nullable: true)]
    public ?int $suggestedPrice;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Optional('tax_inclusive', nullable: true)]
    public ?bool $taxInclusive;

    /**
     * `new OneTimePrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OneTimePrice::with(currency: ..., price: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OneTimePrice)->withCurrency(...)->withPrice(...)
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
     */
    public static function with(
        Currency|string $currency,
        int $price,
        ?int $discount = null,
        ?int $discountBps = null,
        ?bool $payWhatYouWant = null,
        ?bool $purchasingPowerParity = null,
        ?int $suggestedPrice = null,
        ?bool $taxInclusive = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['price'] = $price;

        null !== $discount && $self['discount'] = $discount;
        null !== $discountBps && $self['discountBps'] = $discountBps;
        null !== $payWhatYouWant && $self['payWhatYouWant'] = $payWhatYouWant;
        null !== $purchasingPowerParity && $self['purchasingPowerParity'] = $purchasingPowerParity;
        null !== $suggestedPrice && $self['suggestedPrice'] = $suggestedPrice;
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
     * The payment amount, in the smallest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     *
     * If [`pay_what_you_want`](Self::pay_what_you_want) is set to `true`, this field represents
     * the **minimum** amount the customer must pay.
     */
    public function withPrice(int $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * @param 'one_time_price' $type
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
     * Indicates whether the customer can pay any amount they choose.
     * If set to `true`, the [`price`](Self::price) field is the minimum amount.
     */
    public function withPayWhatYouWant(bool $payWhatYouWant): self
    {
        $self = clone $this;
        $self['payWhatYouWant'] = $payWhatYouWant;

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
     * A suggested price for the user to pay. This value is only considered if
     * [`pay_what_you_want`](Self::pay_what_you_want) is `true`. Otherwise, it is ignored.
     */
    public function withSuggestedPrice(?int $suggestedPrice): self
    {
        $self = clone $this;
        $self['suggestedPrice'] = $suggestedPrice;

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
