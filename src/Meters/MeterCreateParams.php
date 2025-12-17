<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\MetersService::create()
 *
 * @phpstan-import-type MeterAggregationShape from \Dodopayments\Meters\MeterAggregation
 * @phpstan-import-type MeterFilterShape from \Dodopayments\Meters\MeterFilter
 *
 * @phpstan-type MeterCreateParamsShape = array{
 *   aggregation: MeterAggregationShape,
 *   eventName: string,
 *   measurementUnit: string,
 *   name: string,
 *   description?: string|null,
 *   filter?: MeterFilterShape|null,
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
    #[Required]
    public MeterAggregation $aggregation;

    /**
     * Event name to track.
     */
    #[Required('event_name')]
    public string $eventName;

    /**
     * measurement unit.
     */
    #[Required('measurement_unit')]
    public string $measurementUnit;

    /**
     * Name of the meter.
     */
    #[Required]
    public string $name;

    /**
     * Optional description of the meter.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Optional filter to apply to the meter.
     */
    #[Optional(nullable: true)]
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
     *
     * @param MeterAggregationShape $aggregation
     * @param MeterFilterShape|null $filter
     */
    public static function with(
        MeterAggregation|array $aggregation,
        string $eventName,
        string $measurementUnit,
        string $name,
        ?string $description = null,
        MeterFilter|array|null $filter = null,
    ): self {
        $self = new self;

        $self['aggregation'] = $aggregation;
        $self['eventName'] = $eventName;
        $self['measurementUnit'] = $measurementUnit;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $filter && $self['filter'] = $filter;

        return $self;
    }

    /**
     * Aggregation configuration for the meter.
     *
     * @param MeterAggregationShape $aggregation
     */
    public function withAggregation(MeterAggregation|array $aggregation): self
    {
        $self = clone $this;
        $self['aggregation'] = $aggregation;

        return $self;
    }

    /**
     * Event name to track.
     */
    public function withEventName(string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    /**
     * measurement unit.
     */
    public function withMeasurementUnit(string $measurementUnit): self
    {
        $self = clone $this;
        $self['measurementUnit'] = $measurementUnit;

        return $self;
    }

    /**
     * Name of the meter.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional description of the meter.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Optional filter to apply to the meter.
     *
     * @param MeterFilterShape|null $filter
     */
    public function withFilter(MeterFilter|array|null $filter): self
    {
        $self = clone $this;
        $self['filter'] = $filter;

        return $self;
    }
}
