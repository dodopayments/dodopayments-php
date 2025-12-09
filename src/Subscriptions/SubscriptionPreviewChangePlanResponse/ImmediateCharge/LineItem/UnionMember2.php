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
 *   chargeableUnits: string,
 *   currency: value-of<Currency>,
 *   freeThreshold: int,
 *   name: string,
 *   pricePerUnit: string,
 *   subtotal: int,
 *   taxInclusive: bool,
 *   taxRate: float,
 *   type: value-of<Type>,
 *   unitsConsumed: string,
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

    #[Required('chargeable_units')]
    public string $chargeableUnits;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('free_threshold')]
    public int $freeThreshold;

    #[Required]
    public string $name;

    #[Required('price_per_unit')]
    public string $pricePerUnit;

    #[Required]
    public int $subtotal;

    #[Required('tax_inclusive')]
    public bool $taxInclusive;

    #[Required('tax_rate')]
    public float $taxRate;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required('units_consumed')]
    public string $unitsConsumed;

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
     *   chargeableUnits: ...,
     *   currency: ...,
     *   freeThreshold: ...,
     *   name: ...,
     *   pricePerUnit: ...,
     *   subtotal: ...,
     *   taxInclusive: ...,
     *   taxRate: ...,
     *   type: ...,
     *   unitsConsumed: ...,
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
        string $chargeableUnits,
        Currency|string $currency,
        int $freeThreshold,
        string $name,
        string $pricePerUnit,
        int $subtotal,
        bool $taxInclusive,
        float $taxRate,
        Type|string $type,
        string $unitsConsumed,
        ?string $description = null,
        ?int $tax = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['chargeableUnits'] = $chargeableUnits;
        $obj['currency'] = $currency;
        $obj['freeThreshold'] = $freeThreshold;
        $obj['name'] = $name;
        $obj['pricePerUnit'] = $pricePerUnit;
        $obj['subtotal'] = $subtotal;
        $obj['taxInclusive'] = $taxInclusive;
        $obj['taxRate'] = $taxRate;
        $obj['type'] = $type;
        $obj['unitsConsumed'] = $unitsConsumed;

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
        $obj['chargeableUnits'] = $chargeableUnits;

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
        $obj['freeThreshold'] = $freeThreshold;

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
        $obj['pricePerUnit'] = $pricePerUnit;

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
        $obj['taxInclusive'] = $taxInclusive;

        return $obj;
    }

    public function withTaxRate(float $taxRate): self
    {
        $obj = clone $this;
        $obj['taxRate'] = $taxRate;

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
        $obj['unitsConsumed'] = $unitsConsumed;

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
