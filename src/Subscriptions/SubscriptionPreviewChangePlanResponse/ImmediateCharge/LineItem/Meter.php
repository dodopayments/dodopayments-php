<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type MeterShape = array{
 *   id: string,
 *   chargeableUnits: string,
 *   currency: Currency|value-of<Currency>,
 *   freeThreshold: int,
 *   name: string,
 *   pricePerUnit: string,
 *   subtotal: int,
 *   taxInclusive: bool,
 *   taxRate: float,
 *   type: 'meter',
 *   unitsConsumed: string,
 *   description?: string|null,
 *   tax?: int|null,
 * }
 */
final class Meter implements BaseModel
{
    /** @use SdkModel<MeterShape> */
    use SdkModel;

    /** @var 'meter' $type */
    #[Required]
    public string $type = 'meter';

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

    #[Required('units_consumed')]
    public string $unitsConsumed;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * `new Meter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meter::with(
     *   id: ...,
     *   chargeableUnits: ...,
     *   currency: ...,
     *   freeThreshold: ...,
     *   name: ...,
     *   pricePerUnit: ...,
     *   subtotal: ...,
     *   taxInclusive: ...,
     *   taxRate: ...,
     *   unitsConsumed: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Meter)
     *   ->withID(...)
     *   ->withChargeableUnits(...)
     *   ->withCurrency(...)
     *   ->withFreeThreshold(...)
     *   ->withName(...)
     *   ->withPricePerUnit(...)
     *   ->withSubtotal(...)
     *   ->withTaxInclusive(...)
     *   ->withTaxRate(...)
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
        string $unitsConsumed,
        ?string $description = null,
        ?int $tax = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['chargeableUnits'] = $chargeableUnits;
        $self['currency'] = $currency;
        $self['freeThreshold'] = $freeThreshold;
        $self['name'] = $name;
        $self['pricePerUnit'] = $pricePerUnit;
        $self['subtotal'] = $subtotal;
        $self['taxInclusive'] = $taxInclusive;
        $self['taxRate'] = $taxRate;
        $self['unitsConsumed'] = $unitsConsumed;

        null !== $description && $self['description'] = $description;
        null !== $tax && $self['tax'] = $tax;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withChargeableUnits(string $chargeableUnits): self
    {
        $self = clone $this;
        $self['chargeableUnits'] = $chargeableUnits;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withFreeThreshold(int $freeThreshold): self
    {
        $self = clone $this;
        $self['freeThreshold'] = $freeThreshold;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withPricePerUnit(string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    public function withSubtotal(int $subtotal): self
    {
        $self = clone $this;
        $self['subtotal'] = $subtotal;

        return $self;
    }

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    public function withTaxRate(float $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }

    /**
     * @param 'meter' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withUnitsConsumed(string $unitsConsumed): self
    {
        $self = clone $this;
        $self['unitsConsumed'] = $unitsConsumed;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withTax(?int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }
}
