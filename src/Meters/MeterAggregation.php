<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterAggregation\Type;

/**
 * @phpstan-type MeterAggregationShape = array{
 *   type: Type|value-of<Type>, key?: string|null
 * }
 */
final class MeterAggregation implements BaseModel
{
    /** @use SdkModel<MeterAggregationShape> */
    use SdkModel;

    /**
     * Aggregation type for the meter.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Required when type is not COUNT.
     */
    #[Optional(nullable: true)]
    public ?string $key;

    /**
     * `new MeterAggregation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MeterAggregation::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MeterAggregation)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(Type|string $type, ?string $key = null): self
    {
        $self = new self;

        $self['type'] = $type;

        null !== $key && $self['key'] = $key;

        return $self;
    }

    /**
     * Aggregation type for the meter.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Required when type is not COUNT.
     */
    public function withKey(?string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }
}
