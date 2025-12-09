<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterAggregation\Type;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter;
use Dodopayments\Meters\MeterFilter\Conjunction;

/**
 * @see Dodopayments\Services\MetersService::create()
 *
 * @phpstan-type MeterCreateParamsShape = array{
 *   aggregation: MeterAggregation|array{type: value-of<Type>, key?: string|null},
 *   event_name: string,
 *   measurement_unit: string,
 *   name: string,
 *   description?: string|null,
 *   filter?: null|MeterFilter|array{
 *     clauses: list<DirectFilterCondition>|list<NestedMeterFilter>,
 *     conjunction: value-of<Conjunction>,
 *   },
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
    #[Required]
    public string $event_name;

    /**
     * measurement unit.
     */
    #[Required]
    public string $measurement_unit;

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
     *
     * @param MeterAggregation|array{
     *   type: value-of<Type>, key?: string|null
     * } $aggregation
     * @param MeterFilter|array{
     *   clauses: list<DirectFilterCondition>|list<NestedMeterFilter>,
     *   conjunction: value-of<Conjunction>,
     * }|null $filter
     */
    public static function with(
        MeterAggregation|array $aggregation,
        string $event_name,
        string $measurement_unit,
        string $name,
        ?string $description = null,
        MeterFilter|array|null $filter = null,
    ): self {
        $obj = new self;

        $obj['aggregation'] = $aggregation;
        $obj['event_name'] = $event_name;
        $obj['measurement_unit'] = $measurement_unit;
        $obj['name'] = $name;

        null !== $description && $obj['description'] = $description;
        null !== $filter && $obj['filter'] = $filter;

        return $obj;
    }

    /**
     * Aggregation configuration for the meter.
     *
     * @param MeterAggregation|array{
     *   type: value-of<Type>, key?: string|null
     * } $aggregation
     */
    public function withAggregation(MeterAggregation|array $aggregation): self
    {
        $obj = clone $this;
        $obj['aggregation'] = $aggregation;

        return $obj;
    }

    /**
     * Event name to track.
     */
    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj['event_name'] = $eventName;

        return $obj;
    }

    /**
     * measurement unit.
     */
    public function withMeasurementUnit(string $measurementUnit): self
    {
        $obj = clone $this;
        $obj['measurement_unit'] = $measurementUnit;

        return $obj;
    }

    /**
     * Name of the meter.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Optional description of the meter.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Optional filter to apply to the meter.
     *
     * @param MeterFilter|array{
     *   clauses: list<DirectFilterCondition>|list<NestedMeterFilter>,
     *   conjunction: value-of<Conjunction>,
     * }|null $filter
     */
    public function withFilter(MeterFilter|array|null $filter): self
    {
        $obj = clone $this;
        $obj['filter'] = $filter;

        return $obj;
    }
}
