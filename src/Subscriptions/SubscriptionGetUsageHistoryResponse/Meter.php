<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type meter_alias = array{
 *   id: string,
 *   chargeableUnits: string,
 *   consumedUnits: string,
 *   currency: value-of<Currency>,
 *   freeThreshold: int,
 *   name: string,
 *   pricePerUnit: string,
 *   totalPrice: int,
 * }
 */
final class Meter implements BaseModel
{
    /** @use SdkModel<meter_alias> */
    use SdkModel;

    /**
     * Meter identifier.
     */
    #[Api]
    public string $id;

    /**
     * Chargeable units (after free threshold) as string for precision.
     */
    #[Api('chargeable_units')]
    public string $chargeableUnits;

    /**
     * Total units consumed as string for precision.
     */
    #[Api('consumed_units')]
    public string $consumedUnits;

    /**
     * Currency for the price per unit.
     *
     * @var value-of<Currency> $currency
     */
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * Free threshold units for this meter.
     */
    #[Api('free_threshold')]
    public int $freeThreshold;

    /**
     * Meter name.
     */
    #[Api]
    public string $name;

    /**
     * Price per unit in string format for precision.
     */
    #[Api('price_per_unit')]
    public string $pricePerUnit;

    /**
     * Total price charged for this meter in smallest currency unit (cents).
     */
    #[Api('total_price')]
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
        $obj = new self;

        $obj->id = $id;
        $obj->chargeableUnits = $chargeableUnits;
        $obj->consumedUnits = $consumedUnits;
        $obj['currency'] = $currency;
        $obj->freeThreshold = $freeThreshold;
        $obj->name = $name;
        $obj->pricePerUnit = $pricePerUnit;
        $obj->totalPrice = $totalPrice;

        return $obj;
    }

    /**
     * Meter identifier.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Chargeable units (after free threshold) as string for precision.
     */
    public function withChargeableUnits(string $chargeableUnits): self
    {
        $obj = clone $this;
        $obj->chargeableUnits = $chargeableUnits;

        return $obj;
    }

    /**
     * Total units consumed as string for precision.
     */
    public function withConsumedUnits(string $consumedUnits): self
    {
        $obj = clone $this;
        $obj->consumedUnits = $consumedUnits;

        return $obj;
    }

    /**
     * Currency for the price per unit.
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
     * Free threshold units for this meter.
     */
    public function withFreeThreshold(int $freeThreshold): self
    {
        $obj = clone $this;
        $obj->freeThreshold = $freeThreshold;

        return $obj;
    }

    /**
     * Meter name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Price per unit in string format for precision.
     */
    public function withPricePerUnit(string $pricePerUnit): self
    {
        $obj = clone $this;
        $obj->pricePerUnit = $pricePerUnit;

        return $obj;
    }

    /**
     * Total price charged for this meter in smallest currency unit (cents).
     */
    public function withTotalPrice(int $totalPrice): self
    {
        $obj = clone $this;
        $obj->totalPrice = $totalPrice;

        return $obj;
    }
}
