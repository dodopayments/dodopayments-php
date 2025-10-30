<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AddMeterToPriceShape = array{
 *   meterID: string,
 *   pricePerUnit: string,
 *   description?: string|null,
 *   freeThreshold?: int|null,
 *   measurementUnit?: string|null,
 *   name?: string|null,
 * }
 */
final class AddMeterToPrice implements BaseModel
{
    /** @use SdkModel<AddMeterToPriceShape> */
    use SdkModel;

    #[Api('meter_id')]
    public string $meterID;

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    #[Api('price_per_unit')]
    public string $pricePerUnit;

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    #[Api('free_threshold', nullable: true, optional: true)]
    public ?int $freeThreshold;

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    #[Api('measurement_unit', nullable: true, optional: true)]
    public ?string $measurementUnit;

    /**
     * Meter name. Will ignored on Request, but will be shown in response.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * `new AddMeterToPrice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddMeterToPrice::with(meterID: ..., pricePerUnit: ...)
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
        string $meterID,
        string $pricePerUnit,
        ?string $description = null,
        ?int $freeThreshold = null,
        ?string $measurementUnit = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj->meterID = $meterID;
        $obj->pricePerUnit = $pricePerUnit;

        null !== $description && $obj->description = $description;
        null !== $freeThreshold && $obj->freeThreshold = $freeThreshold;
        null !== $measurementUnit && $obj->measurementUnit = $measurementUnit;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    public function withMeterID(string $meterID): self
    {
        $obj = clone $this;
        $obj->meterID = $meterID;

        return $obj;
    }

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    public function withPricePerUnit(string $pricePerUnit): self
    {
        $obj = clone $this;
        $obj->pricePerUnit = $pricePerUnit;

        return $obj;
    }

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    public function withFreeThreshold(?int $freeThreshold): self
    {
        $obj = clone $this;
        $obj->freeThreshold = $freeThreshold;

        return $obj;
    }

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    public function withMeasurementUnit(?string $measurementUnit): self
    {
        $obj = clone $this;
        $obj->measurementUnit = $measurementUnit;

        return $obj;
    }

    /**
     * Meter name. Will ignored on Request, but will be shown in response.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
