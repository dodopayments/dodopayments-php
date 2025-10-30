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
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   eventName: string,
 *   measurementUnit: string,
 *   name: string,
 *   updatedAt: \DateTimeInterface,
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

    #[Api('business_id')]
    public string $businessID;

    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    #[Api('event_name')]
    public string $eventName;

    #[Api('measurement_unit')]
    public string $measurementUnit;

    #[Api]
    public string $name;

    #[Api('updated_at')]
    public \DateTimeInterface $updatedAt;

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
     *   businessID: ...,
     *   createdAt: ...,
     *   eventName: ...,
     *   measurementUnit: ...,
     *   name: ...,
     *   updatedAt: ...,
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
        string $businessID,
        \DateTimeInterface $createdAt,
        string $eventName,
        string $measurementUnit,
        string $name,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        ?MeterFilter $filter = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->aggregation = $aggregation;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->eventName = $eventName;
        $obj->measurementUnit = $measurementUnit;
        $obj->name = $name;
        $obj->updatedAt = $updatedAt;

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
        $obj->businessID = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj->eventName = $eventName;

        return $obj;
    }

    public function withMeasurementUnit(string $measurementUnit): self
    {
        $obj = clone $this;
        $obj->measurementUnit = $measurementUnit;

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
        $obj->updatedAt = $updatedAt;

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
