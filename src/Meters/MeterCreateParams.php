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
 * @phpstan-type MeterCreateParamsShape = array{
 *   aggregation: MeterAggregation,
 *   event_name: string,
 *   measurement_unit: string,
 *   name: string,
 *   description?: string|null,
 *   filter?: MeterFilter|null,
 * }
 */
final class MeterCreateParams implements BaseModel
{
    /** @use SdkModel<MeterCreateParamsShape> */
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
    #[Api]
    public string $event_name;

    /**
     * measurement unit.
     */
    #[Api]
    public string $measurement_unit;

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
     *   aggregation: ..., event_name: ..., measurement_unit: ..., name: ...
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
        string $event_name,
        string $measurement_unit,
        string $name,
        ?string $description = null,
        ?MeterFilter $filter = null,
    ): self {
        $obj = new self;

        $obj->aggregation = $aggregation;
        $obj->event_name = $event_name;
        $obj->measurement_unit = $measurement_unit;
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
        $obj->event_name = $eventName;

        return $obj;
    }

    /**
     * measurement unit.
     */
    public function withMeasurementUnit(string $measurementUnit): self
    {
        $obj = clone $this;
        $obj->measurement_unit = $measurementUnit;

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
    public function withFilter(?MeterFilter $filter): self
    {
        $obj = clone $this;
        $obj->filter = $filter;

        return $obj;
    }
}
