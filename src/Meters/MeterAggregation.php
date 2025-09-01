<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterAggregation\Type;

/**
 * @phpstan-type meter_aggregation = array{type: Type::*, key?: string|null}
 */
final class MeterAggregation implements BaseModel
{
    /** @use SdkModel<meter_aggregation> */
    use SdkModel;

    /**
     * Aggregation type for the meter.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Required when type is not COUNT.
     */
    #[Api(nullable: true, optional: true)]
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
     * @param Type::* $type
     */
    public static function with(string $type, ?string $key = null): self
    {
        $obj = new self;

        $obj->type = $type;

        null !== $key && $obj->key = $key;

        return $obj;
    }

    /**
     * Aggregation type for the meter.
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Required when type is not COUNT.
     */
    public function withKey(?string $key): self
    {
        $obj = clone $this;
        $obj->key = $key;

        return $obj;
    }
}
