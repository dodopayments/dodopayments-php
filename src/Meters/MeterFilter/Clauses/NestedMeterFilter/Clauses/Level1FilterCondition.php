<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition\Operator;

/**
 * Filter condition with key, operator, and value.
 *
 * @phpstan-type Level1FilterConditionShape = array{
 *   key: string, operator: value-of<Operator>, value: string|float|bool
 * }
 */
final class Level1FilterCondition implements BaseModel
{
    /** @use SdkModel<Level1FilterConditionShape> */
    use SdkModel;

    /**
     * Filter key to apply.
     */
    #[Api]
    public string $key;

    /** @var value-of<Operator> $operator */
    #[Api(enum: Operator::class)]
    public string $operator;

    /**
     * Filter value - can be string, number, or boolean.
     */
    #[Api]
    public string|float|bool $value;

    /**
     * `new Level1FilterCondition()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Level1FilterCondition::with(key: ..., operator: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Level1FilterCondition)->withKey(...)->withOperator(...)->withValue(...)
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
     * @param Operator|value-of<Operator> $operator
     */
    public static function with(
        string $key,
        Operator|string $operator,
        string|float|bool $value
    ): self {
        $obj = new self;

        $obj['key'] = $key;
        $obj['operator'] = $operator;
        $obj['value'] = $value;

        return $obj;
    }

    /**
     * Filter key to apply.
     */
    public function withKey(string $key): self
    {
        $obj = clone $this;
        $obj['key'] = $key;

        return $obj;
    }

    /**
     * @param Operator|value-of<Operator> $operator
     */
    public function withOperator(Operator|string $operator): self
    {
        $obj = clone $this;
        $obj['operator'] = $operator;

        return $obj;
    }

    /**
     * Filter value - can be string, number, or boolean.
     */
    public function withValue(string|float|bool $value): self
    {
        $obj = clone $this;
        $obj['value'] = $value;

        return $obj;
    }
}
