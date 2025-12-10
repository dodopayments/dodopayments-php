<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Clause\Operator;

/**
 * Filter condition with key, operator, and value.
 *
 * @phpstan-type ClauseShape = array{
 *   key: string, operator: value-of<Operator>, value: string|float|bool
 * }
 */
final class Clause implements BaseModel
{
    /** @use SdkModel<ClauseShape> */
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
     * `new Clause()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Clause::with(key: ..., operator: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Clause)->withKey(...)->withOperator(...)->withValue(...)
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
     */
    public function withValue(string|float|bool $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
