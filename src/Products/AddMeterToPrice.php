<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AddMeterToPriceShape = array{
 *   meter_id: string,
 *   price_per_unit: string,
 *   description?: string|null,
 *   free_threshold?: int|null,
 *   measurement_unit?: string|null,
 *   name?: string|null,
 * }
 */
final class AddMeterToPrice implements BaseModel
{
    /** @use SdkModel<AddMeterToPriceShape> */
    use SdkModel;

    #[Required]
    public string $meter_id;

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    #[Required]
    public string $price_per_unit;

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?int $free_threshold;

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    #[Optional(nullable: true)]
    public ?string $measurement_unit;

    /**
     * Meter name. Will ignored on Request, but will be shown in response.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new AddMeterToPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddMeterToPrice::with(meter_id: ..., price_per_unit: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AddMeterToPrice)->withMeterID(...)->withPricePerUnit(...)
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
     */
    public static function with(
        string $meter_id,
        string $price_per_unit,
        ?string $description = null,
        ?int $free_threshold = null,
        ?string $measurement_unit = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj['meter_id'] = $meter_id;
        $obj['price_per_unit'] = $price_per_unit;

        null !== $description && $obj['description'] = $description;
        null !== $free_threshold && $obj['free_threshold'] = $free_threshold;
        null !== $measurement_unit && $obj['measurement_unit'] = $measurement_unit;
        null !== $name && $obj['name'] = $name;

        return $obj;
    }

    public function withMeterID(string $meterID): self
    {
        $obj = clone $this;
        $obj['meter_id'] = $meterID;

        return $obj;
    }

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    public function withPricePerUnit(string $pricePerUnit): self
    {
        $obj = clone $this;
        $obj['price_per_unit'] = $pricePerUnit;

        return $obj;
    }

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    public function withFreeThreshold(?int $freeThreshold): self
    {
        $obj = clone $this;
        $obj['free_threshold'] = $freeThreshold;

        return $obj;
    }

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    public function withMeasurementUnit(?string $measurementUnit): self
    {
        $obj = clone $this;
        $obj['measurement_unit'] = $measurementUnit;

        return $obj;
    }

    /**
     * Meter name. Will ignored on Request, but will be shown in response.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }
}
