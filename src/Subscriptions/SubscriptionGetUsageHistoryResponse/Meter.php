<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type MeterShape = array{
 *   id: string,
 *   chargeableUnits: string,
 *   consumedUnits: string,
 *   currency: Currency|value-of<Currency>,
 *   freeThreshold: int,
 *   name: string,
 *   pricePerUnit: string,
 *   totalPrice: int,
 * }
 */
final class Meter implements BaseModel
{
    /** @use SdkModel<MeterShape> */
    use SdkModel;

    /**
     * Meter identifier.
     */
    #[Required]
    public string $id;

    /**
     * Chargeable units (after free threshold) as string for precision.
     */
    #[Required('chargeable_units')]
    public string $chargeableUnits;

    /**
     * Total units consumed as string for precision.
     */
    #[Required('consumed_units')]
    public string $consumedUnits;

    /**
     * Currency for the price per unit.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Free threshold units for this meter.
     */
    #[Required('free_threshold')]
    public int $freeThreshold;

    /**
     * Meter name.
     */
    #[Required]
    public string $name;

    /**
     * Price per unit in string format for precision.
     */
    #[Required('price_per_unit')]
    public string $pricePerUnit;

    /**
     * Total price charged for this meter in smallest currency unit (cents).
     */
    #[Required('total_price')]
    public int $totalPrice;

    /**
     * `new Meter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meter::with(
     *   id: ...,
     *   chargeableUnits: ...,
     *   consumedUnits: ...,
     *   currency: ...,
     *   freeThreshold: ...,
     *   name: ...,
     *   pricePerUnit: ...,
     *   totalPrice: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Meter)
     *   ->withID(...)
     *   ->withChargeableUnits(...)
     *   ->withConsumedUnits(...)
     *   ->withCurrency(...)
     *   ->withFreeThreshold(...)
     *   ->withName(...)
     *   ->withPricePerUnit(...)
     *   ->withTotalPrice(...)
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
        string $consumedUnits,
        Currency|string $currency,
        int $freeThreshold,
        string $name,
        string $pricePerUnit,
        int $totalPrice,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['chargeableUnits'] = $chargeableUnits;
        $self['consumedUnits'] = $consumedUnits;
        $self['currency'] = $currency;
        $self['freeThreshold'] = $freeThreshold;
        $self['name'] = $name;
        $self['pricePerUnit'] = $pricePerUnit;
        $self['totalPrice'] = $totalPrice;

        return $self;
    }

    /**
     * Meter identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Chargeable units (after free threshold) as string for precision.
     */
    public function withChargeableUnits(string $chargeableUnits): self
    {
        $self = clone $this;
        $self['chargeableUnits'] = $chargeableUnits;

        return $self;
    }

    /**
     * Total units consumed as string for precision.
     */
    public function withConsumedUnits(string $consumedUnits): self
    {
        $self = clone $this;
        $self['consumedUnits'] = $consumedUnits;

        return $self;
    }

    /**
     * Currency for the price per unit.
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
     * Free threshold units for this meter.
     */
    public function withFreeThreshold(int $freeThreshold): self
    {
        $self = clone $this;
        $self['freeThreshold'] = $freeThreshold;

        return $self;
    }

    /**
     * Meter name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Price per unit in string format for precision.
     */
    public function withPricePerUnit(string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    /**
     * Total price charged for this meter in smallest currency unit (cents).
     */
    public function withTotalPrice(int $totalPrice): self
    {
        $self = clone $this;
        $self['totalPrice'] = $totalPrice;

        return $self;
    }
}
