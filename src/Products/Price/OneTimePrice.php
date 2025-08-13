<?php

declare(strict_types=1);

namespace DodopaymentsClient\Products\Price;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Products\Price\OneTimePrice\Type;

/**
 * One-time price details.
 *
 * @phpstan-type one_time_price_alias = array{
 *   currency: Currency::*,
 *   discount: float,
 *   price: int,
 *   purchasingPowerParity: bool,
 *   type: Type::*,
 *   payWhatYouWant?: bool,
 *   suggestedPrice?: int|null,
 *   taxInclusive?: bool|null,
 * }
 */
final class OneTimePrice implements BaseModel
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
     * The payment amount, in the smallest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     *
     * If [`pay_what_you_want`](Self::pay_what_you_want) is set to `true`, this field represents
     * the **minimum** amount the customer must pay.
     */
    #[Api]
    public int $price;

    /**
     * Indicates if purchasing power parity adjustments are applied to the price.
     * Purchasing power parity feature is not available as of now.
     */
    #[Api('purchasing_power_parity')]
    public bool $purchasingPowerParity;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Indicates whether the customer can pay any amount they choose.
     * If set to `true`, the [`price`](Self::price) field is the minimum amount.
     */
    #[Api('pay_what_you_want', optional: true)]
    public ?bool $payWhatYouWant;

    /**
     * A suggested price for the user to pay. This value is only considered if
     * [`pay_what_you_want`](Self::pay_what_you_want) is `true`. Otherwise, it is ignored.
     */
    #[Api('suggested_price', optional: true)]
    public ?int $suggestedPrice;

    /**
     * Indicates if the price is tax inclusive.
     */
    #[Api('tax_inclusive', optional: true)]
    public ?bool $taxInclusive;

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
     * @param Type::* $type
     */
    public static function from(
        string $currency,
        float $discount,
        int $price,
        bool $purchasingPowerParity,
        string $type,
        ?bool $payWhatYouWant = null,
        ?int $suggestedPrice = null,
        ?bool $taxInclusive = null,
    ): self {
        $obj = new self;

        $obj->currency = $currency;
        $obj->discount = $discount;
        $obj->price = $price;
        $obj->purchasingPowerParity = $purchasingPowerParity;
        $obj->type = $type;

        null !== $payWhatYouWant && $obj->payWhatYouWant = $payWhatYouWant;
        null !== $suggestedPrice && $obj->suggestedPrice = $suggestedPrice;
        null !== $taxInclusive && $obj->taxInclusive = $taxInclusive;

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
     * The payment amount, in the smallest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     *
     * If [`pay_what_you_want`](Self::pay_what_you_want) is set to `true`, this field represents
     * the **minimum** amount the customer must pay.
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
     * @param Type::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Indicates whether the customer can pay any amount they choose.
     * If set to `true`, the [`price`](Self::price) field is the minimum amount.
     */
    public function setPayWhatYouWant(bool $payWhatYouWant): self
    {
        $this->payWhatYouWant = $payWhatYouWant;

        return $this;
    }

    /**
     * A suggested price for the user to pay. This value is only considered if
     * [`pay_what_you_want`](Self::pay_what_you_want) is `true`. Otherwise, it is ignored.
     */
    public function setSuggestedPrice(?int $suggestedPrice): self
    {
        $this->suggestedPrice = $suggestedPrice;

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
}
