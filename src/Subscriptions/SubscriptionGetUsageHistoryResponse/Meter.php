<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type MeterShape = array{
 *   id: string,
 *   chargeable_units: string,
 *   consumed_units: string,
 *   currency: value-of<Currency>,
 *   free_threshold: int,
 *   name: string,
 *   price_per_unit: string,
 *   total_price: int,
 * }
 */
final class Meter implements BaseModel
{
    /** @use SdkModel<MeterShape> */
    use SdkModel;

    /**
     * Meter identifier.
     */
    #[Api]
    public string $id;

    /**
     * Chargeable units (after free threshold) as string for precision.
     */
    #[Api]
    public string $chargeable_units;

    /**
     * Total units consumed as string for precision.
     */
    #[Api]
    public string $consumed_units;

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
    #[Api]
    public int $free_threshold;

    /**
     * Meter name.
     */
    #[Api]
    public string $name;

    /**
     * Price per unit in string format for precision.
     */
    #[Api]
    public string $price_per_unit;

    /**
     * Total price charged for this meter in smallest currency unit (cents).
     */
    #[Api]
    public int $total_price;

    /**
     * `new Meter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meter::with(
     *   id: ...,
     *   chargeable_units: ...,
     *   consumed_units: ...,
     *   currency: ...,
     *   free_threshold: ...,
     *   name: ...,
     *   price_per_unit: ...,
     *   total_price: ...,
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
        string $chargeable_units,
        string $consumed_units,
        Currency|string $currency,
        int $free_threshold,
        string $name,
        string $price_per_unit,
        int $total_price,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['chargeable_units'] = $chargeable_units;
        $obj['consumed_units'] = $consumed_units;
        $obj['currency'] = $currency;
        $obj['free_threshold'] = $free_threshold;
        $obj['name'] = $name;
        $obj['price_per_unit'] = $price_per_unit;
        $obj['total_price'] = $total_price;

        return $obj;
    }

    /**
     * Meter identifier.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Chargeable units (after free threshold) as string for precision.
     */
    public function withChargeableUnits(string $chargeableUnits): self
    {
        $obj = clone $this;
        $obj['chargeable_units'] = $chargeableUnits;

        return $obj;
    }

    /**
     * Total units consumed as string for precision.
     */
    public function withConsumedUnits(string $consumedUnits): self
    {
        $obj = clone $this;
        $obj['consumed_units'] = $consumedUnits;

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
        $obj['free_threshold'] = $freeThreshold;

        return $obj;
    }

    /**
     * Meter name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Price per unit in string format for precision.
     */
    public function withPricePerUnit(string $pricePerUnit): self
    {
        $obj = clone $this;
        $obj['price_per_unit'] = $pricePerUnit;

        return $obj;
    }

    /**
     * Total price charged for this meter in smallest currency unit (cents).
     */
    public function withTotalPrice(int $totalPrice): self
    {
        $obj = clone $this;
        $obj['total_price'] = $totalPrice;

        return $obj;
    }
}
