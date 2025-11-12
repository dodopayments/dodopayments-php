<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type MeterShape = array{
 *   id: string,
 *   aggregation: MeterAggregation,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   event_name: string,
 *   measurement_unit: string,
 *   name: string,
 *   updated_at: \DateTimeInterface,
 *   description?: string|null,
 *   filter?: MeterFilter|null,
 * }
 */
final class Meter implements BaseModel, ResponseConverter
{
    /** @use SdkModel<MeterShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $id;

    #[Api]
    public MeterAggregation $aggregation;

    #[Api]
    public string $business_id;

    #[Api]
    public \DateTimeInterface $created_at;

    #[Api]
    public string $event_name;

    #[Api]
    public string $measurement_unit;

    #[Api]
    public string $name;

    #[Api]
    public \DateTimeInterface $updated_at;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * A filter structure that combines multiple conditions with logical conjunctions (AND/OR).
     *
     * Supports up to 3 levels of nesting to create complex filter expressions.
     * Each filter has a conjunction (and/or) and clauses that can be either direct conditions or nested filters.
     */
    #[Api(nullable: true, optional: true)]
    public ?MeterFilter $filter;

    /**
     * `new Meter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meter::with(
     *   id: ...,
     *   aggregation: ...,
     *   business_id: ...,
     *   created_at: ...,
     *   event_name: ...,
     *   measurement_unit: ...,
     *   name: ...,
     *   updated_at: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Meter)
     *   ->withID(...)
     *   ->withAggregation(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withEventName(...)
     *   ->withMeasurementUnit(...)
     *   ->withName(...)
     *   ->withUpdatedAt(...)
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
        string $id,
        MeterAggregation $aggregation,
        string $business_id,
        \DateTimeInterface $created_at,
        string $event_name,
        string $measurement_unit,
        string $name,
        \DateTimeInterface $updated_at,
        ?string $description = null,
        ?MeterFilter $filter = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->aggregation = $aggregation;
        $obj->business_id = $business_id;
        $obj->created_at = $created_at;
        $obj->event_name = $event_name;
        $obj->measurement_unit = $measurement_unit;
        $obj->name = $name;
        $obj->updated_at = $updated_at;

        null !== $description && $obj->description = $description;
        null !== $filter && $obj->filter = $filter;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withAggregation(MeterAggregation $aggregation): self
    {
        $obj = clone $this;
        $obj->aggregation = $aggregation;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->business_id = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->created_at = $createdAt;

        return $obj;
    }

    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj->event_name = $eventName;

        return $obj;
    }

    public function withMeasurementUnit(string $measurementUnit): self
    {
        $obj = clone $this;
        $obj->measurement_unit = $measurementUnit;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updated_at = $updatedAt;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * A filter structure that combines multiple conditions with logical conjunctions (AND/OR).
     *
     * Supports up to 3 levels of nesting to create complex filter expressions.
     * Each filter has a conjunction (and/or) and clauses that can be either direct conditions or nested filters.
     */
    public function withFilter(?MeterFilter $filter): self
    {
        $obj = clone $this;
        $obj->filter = $filter;

        return $obj;
    }
}
