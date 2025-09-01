<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Meters->create
 *
 * @phpstan-type meter_create_params = array{
 *   aggregation: MeterAggregation,
 *   eventName: string,
 *   measurementUnit: string,
 *   name: string,
 *   description?: string|null,
 *   filter?: MeterFilter,
 * }
 */
final class MeterCreateParams implements BaseModel
{
    /** @use SdkModel<meter_create_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Aggregation configuration for the meter.
     */
    #[Api]
    public MeterAggregation $aggregation;

    /**
     * Event name to track.
     */
    #[Api('event_name')]
    public string $eventName;

    /**
     * measurement unit.
     */
    #[Api('measurement_unit')]
    public string $measurementUnit;

    /**
     * Name of the meter.
     */
    #[Api]
    public string $name;

    /**
     * Optional description of the meter.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Optional filter to apply to the meter.
     */
    #[Api(nullable: true, optional: true)]
    public ?MeterFilter $filter;

    /**
     * `new MeterCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MeterCreateParams::with(
     *   aggregation: ..., eventName: ..., measurementUnit: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MeterCreateParams)
     *   ->withAggregation(...)
     *   ->withEventName(...)
     *   ->withMeasurementUnit(...)
     *   ->withName(...)
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
        MeterAggregation $aggregation,
        string $eventName,
        string $measurementUnit,
        string $name,
        ?string $description = null,
        ?MeterFilter $filter = null,
    ): self {
        $obj = new self;

        $obj->aggregation = $aggregation;
        $obj->eventName = $eventName;
        $obj->measurementUnit = $measurementUnit;
        $obj->name = $name;

        null !== $description && $obj->description = $description;
        null !== $filter && $obj->filter = $filter;

        return $obj;
    }

    /**
     * Aggregation configuration for the meter.
     */
    public function withAggregation(MeterAggregation $aggregation): self
    {
        $obj = clone $this;
        $obj->aggregation = $aggregation;

        return $obj;
    }

    /**
     * Event name to track.
     */
    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj->eventName = $eventName;

        return $obj;
    }

    /**
     * measurement unit.
     */
    public function withMeasurementUnit(string $measurementUnit): self
    {
        $obj = clone $this;
        $obj->measurementUnit = $measurementUnit;

        return $obj;
    }

    /**
     * Name of the meter.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Optional description of the meter.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Optional filter to apply to the meter.
     */
    public function withFilter(MeterFilter $filter): self
    {
        $obj = clone $this;
        $obj->filter = $filter;

        return $obj;
    }
}
