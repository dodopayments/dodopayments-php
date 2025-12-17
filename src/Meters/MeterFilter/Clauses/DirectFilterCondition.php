<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition\Operator;

/**
 * Filter condition with key, operator, and value.
 *
 * @phpstan-import-type ValueShape from \Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition\Value
 *
 * @phpstan-type DirectFilterConditionShape = array{
 *   key: string, operator: Operator|value-of<Operator>, value: ValueShape
 * }
 */
final class DirectFilterCondition implements BaseModel
{
    /** @use SdkModel<DirectFilterConditionShape> */
    use SdkModel;

    /**
     * Filter key to apply.
     */
    #[Required]
    public string $key;

    /** @var value-of<Operator> $operator */
    #[Required(enum: Operator::class)]
    public string $operator;

    /**
     * Filter value - can be string, number, or boolean.
     */
    #[Required]
    public string|float|bool $value;

    /**
     * `new DirectFilterCondition()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DirectFilterCondition::with(key: ..., operator: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DirectFilterCondition)->withKey(...)->withOperator(...)->withValue(...)
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
     * @param ValueShape $value
     */
    public static function with(
        string $key,
        Operator|string $operator,
        string|float|bool $value
    ): self {
        $self = new self;

        $self['key'] = $key;
        $self['operator'] = $operator;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Filter key to apply.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * @param Operator|value-of<Operator> $operator
     */
    public function withOperator(Operator|string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * Filter value - can be string, number, or boolean.
     *
     * @param ValueShape $value
     */
    public function withValue(string|float|bool $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
