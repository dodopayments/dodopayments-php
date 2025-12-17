<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MeterAggregationShape from \Dodopayments\Meters\MeterAggregation
 * @phpstan-import-type MeterFilterShape from \Dodopayments\Meters\MeterFilter
 *
 * @phpstan-type MeterShape = array{
 *   id: string,
 *   aggregation: MeterAggregation|MeterAggregationShape,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   eventName: string,
 *   measurementUnit: string,
 *   name: string,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   filter?: null|MeterFilter|MeterFilterShape,
 * }
 */
final class Meter implements BaseModel
{
    /** @use SdkModel<MeterShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public MeterAggregation $aggregation;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('event_name')]
    public string $eventName;

    #[Required('measurement_unit')]
    public string $measurementUnit;

    #[Required]
    public string $name;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * A filter structure that combines multiple conditions with logical conjunctions (AND/OR).
     *
     * Supports up to 3 levels of nesting to create complex filter expressions.
     * Each filter has a conjunction (and/or) and clauses that can be either direct conditions or nested filters.
     */
    #[Optional(nullable: true)]
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
     *
     * @param MeterAggregationShape $aggregation
     * @param MeterFilterShape|null $filter
     */
    public static function with(
        string $id,
        MeterAggregation|array $aggregation,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $eventName,
        string $measurementUnit,
        string $name,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        MeterFilter|array|null $filter = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['aggregation'] = $aggregation;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['eventName'] = $eventName;
        $self['measurementUnit'] = $measurementUnit;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;
        null !== $filter && $self['filter'] = $filter;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param MeterAggregationShape $aggregation
     */
    public function withAggregation(MeterAggregation|array $aggregation): self
    {
        $self = clone $this;
        $self['aggregation'] = $aggregation;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withEventName(string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    public function withMeasurementUnit(string $measurementUnit): self
    {
        $self = clone $this;
        $self['measurementUnit'] = $measurementUnit;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * A filter structure that combines multiple conditions with logical conjunctions (AND/OR).
     *
     * Supports up to 3 levels of nesting to create complex filter expressions.
     * Each filter has a conjunction (and/or) and clauses that can be either direct conditions or nested filters.
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
