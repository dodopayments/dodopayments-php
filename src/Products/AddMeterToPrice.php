<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
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

    #[Required('meter_id')]
    public string $meterID;

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    #[Required('price_per_unit')]
    public string $pricePerUnit;

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('free_threshold', nullable: true)]
    public ?int $freeThreshold;

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    #[Optional('measurement_unit', nullable: true)]
    public ?string $measurementUnit;

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
        $self = new self;

        $self['meterID'] = $meterID;
        $self['pricePerUnit'] = $pricePerUnit;

        null !== $description && $self['description'] = $description;
        null !== $freeThreshold && $self['freeThreshold'] = $freeThreshold;
        null !== $measurementUnit && $self['measurementUnit'] = $measurementUnit;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withMeterID(string $meterID): self
    {
        $self = clone $this;
        $self['meterID'] = $meterID;

        return $self;
    }

    /**
     * The price per unit in lowest denomination. Must be greater than zero. Supports up to 5 digits before decimal point and 12 decimal places.
     */
    public function withPricePerUnit(string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    /**
     * Meter description. Will ignored on Request, but will be shown in response.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withFreeThreshold(?int $freeThreshold): self
    {
        $self = clone $this;
        $self['freeThreshold'] = $freeThreshold;

        return $self;
    }

    /**
     * Meter measurement unit. Will ignored on Request, but will be shown in response.
     */
    public function withMeasurementUnit(?string $measurementUnit): self
    {
        $self = clone $this;
        $self['measurementUnit'] = $measurementUnit;

        return $self;
    }

    /**
     * Meter name. Will ignored on Request, but will be shown in response.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
