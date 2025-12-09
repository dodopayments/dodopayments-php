<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\Price\OneTimePrice\Type;

/**
 * One-time price details.
 *
 * @phpstan-type OneTimePriceShape = array{
 *   currency: value-of<Currency>,
 *   discount: int,
 *   price: int,
 *   purchasingPowerParity: bool,
 *   type: value-of<Type>,
 *   payWhatYouWant?: bool|null,
 *   suggestedPrice?: int|null,
 *   taxInclusive?: bool|null,
 * }
 */
final class OneTimePrice implements BaseModel
{
    /** @use SdkModel<OneTimePriceShape> */
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
     * The payment amount, in the smallest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     *
     * If [`pay_what_you_want`](Self::pay_what_you_want) is set to `true`, this field represents
     * the **minimum** amount the customer must pay.
     */
    #[Required]
    public int $price;

    /**
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    #[Required('purchasing_power_parity')]
    public bool $purchasingPowerParity;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Indicates whether the customer can pay any amount they choose.
     * If set to `true`, the [`price`](Self::price) field is the minimum amount.
     */
    #[Optional('pay_what_you_want')]
    public ?bool $payWhatYouWant;

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
     * OneTimePrice::with(
     *   currency: ...,
     *   discount: ...,
     *   price: ...,
     *   purchasingPowerParity: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OneTimePrice)
     *   ->withCurrency(...)
     *   ->withDiscount(...)
     *   ->withPrice(...)
     *   ->withPurchasingPowerParity(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Currency|string $currency,
        int $discount,
        int $price,
        bool $purchasingPowerParity,
        Type|string $type,
        ?bool $payWhatYouWant = null,
        ?int $suggestedPrice = null,
        ?bool $taxInclusive = null,
    ): self {
        $obj = new self;

        $obj['currency'] = $currency;
        $obj['discount'] = $discount;
        $obj['price'] = $price;
        $obj['purchasingPowerParity'] = $purchasingPowerParity;
        $obj['type'] = $type;

        null !== $payWhatYouWant && $obj['payWhatYouWant'] = $payWhatYouWant;
        null !== $suggestedPrice && $obj['suggestedPrice'] = $suggestedPrice;
        null !== $taxInclusive && $obj['taxInclusive'] = $taxInclusive;

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
     * The payment amount, in the smallest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     *
     * If [`pay_what_you_want`](Self::pay_what_you_want) is set to `true`, this field represents
     * the **minimum** amount the customer must pay.
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
        $obj['purchasingPowerParity'] = $purchasingPowerParity;

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
     * Indicates whether the customer can pay any amount they choose.
     * If set to `true`, the [`price`](Self::price) field is the minimum amount.
     */
    public function withPayWhatYouWant(bool $payWhatYouWant): self
    {
        $obj = clone $this;
        $obj['payWhatYouWant'] = $payWhatYouWant;

        return $obj;
    }

    /**
     * A suggested price for the user to pay. This value is only considered if
     * [`pay_what_you_want`](Self::pay_what_you_want) is `true`. Otherwise, it is ignored.
     */
    public function withSuggestedPrice(?int $suggestedPrice): self
    {
        $obj = clone $this;
        $obj['suggestedPrice'] = $suggestedPrice;

        return $obj;
    }

    /**
     * Indicates if the price is tax inclusive.
     */
    public function withTaxInclusive(?bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['taxInclusive'] = $taxInclusive;

        return $obj;
    }
}
