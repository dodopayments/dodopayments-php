<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember2\Type;

/**
 * @phpstan-type UnionMember2Shape = array{
 *   id: string,
 *   chargeable_units: string,
 *   currency: value-of<Currency>,
 *   free_threshold: int,
 *   name: string,
 *   price_per_unit: string,
 *   subtotal: int,
 *   tax_inclusive: bool,
 *   tax_rate: float,
 *   type: value-of<Type>,
 *   units_consumed: string,
 *   description?: string|null,
 *   tax?: int|null,
 * }
 */
final class UnionMember2 implements BaseModel
{
    /** @use SdkModel<UnionMember2Shape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $chargeable_units;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public int $free_threshold;

    #[Required]
    public string $name;

    #[Required]
    public string $price_per_unit;

    #[Required]
    public int $subtotal;

    #[Required]
    public bool $tax_inclusive;

    #[Required]
    public float $tax_rate;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required]
    public string $units_consumed;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * `new UnionMember2()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember2::with(
     *   id: ...,
     *   chargeable_units: ...,
     *   currency: ...,
     *   free_threshold: ...,
     *   name: ...,
     *   price_per_unit: ...,
     *   subtotal: ...,
     *   tax_inclusive: ...,
     *   tax_rate: ...,
     *   type: ...,
     *   units_consumed: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember2)
     *   ->withID(...)
     *   ->withChargeableUnits(...)
     *   ->withCurrency(...)
     *   ->withFreeThreshold(...)
     *   ->withName(...)
     *   ->withPricePerUnit(...)
     *   ->withSubtotal(...)
     *   ->withTaxInclusive(...)
     *   ->withTaxRate(...)
     *   ->withType(...)
     *   ->withUnitsConsumed(...)
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
        string $id,
        string $chargeable_units,
        Currency|string $currency,
        int $free_threshold,
        string $name,
        string $price_per_unit,
        int $subtotal,
        bool $tax_inclusive,
        float $tax_rate,
        Type|string $type,
        string $units_consumed,
        ?string $description = null,
        ?int $tax = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['chargeable_units'] = $chargeable_units;
        $obj['currency'] = $currency;
        $obj['free_threshold'] = $free_threshold;
        $obj['name'] = $name;
        $obj['price_per_unit'] = $price_per_unit;
        $obj['subtotal'] = $subtotal;
        $obj['tax_inclusive'] = $tax_inclusive;
        $obj['tax_rate'] = $tax_rate;
        $obj['type'] = $type;
        $obj['units_consumed'] = $units_consumed;

        null !== $description && $obj['description'] = $description;
        null !== $tax && $obj['tax'] = $tax;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withChargeableUnits(string $chargeableUnits): self
    {
        $obj = clone $this;
        $obj['chargeable_units'] = $chargeableUnits;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    public function withFreeThreshold(int $freeThreshold): self
    {
        $obj = clone $this;
        $obj['free_threshold'] = $freeThreshold;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withPricePerUnit(string $pricePerUnit): self
    {
        $obj = clone $this;
        $obj['price_per_unit'] = $pricePerUnit;

        return $obj;
    }

    public function withSubtotal(int $subtotal): self
    {
        $obj = clone $this;
        $obj['subtotal'] = $subtotal;

        return $obj;
    }

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['tax_inclusive'] = $taxInclusive;

        return $obj;
    }

    public function withTaxRate(float $taxRate): self
    {
        $obj = clone $this;
        $obj['tax_rate'] = $taxRate;

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

    public function withUnitsConsumed(string $unitsConsumed): self
    {
        $obj = clone $this;
        $obj['units_consumed'] = $unitsConsumed;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    public function withTax(?int $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }
}
