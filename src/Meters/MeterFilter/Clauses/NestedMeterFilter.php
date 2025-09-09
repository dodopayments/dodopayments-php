<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Conjunction;

/**
 * Level 1 nested filter - can contain Level 2 filters.
 *
 * @phpstan-type nested_meter_filter = array{
 *   clauses: list<Level1FilterCondition>|list<Level1NestedFilter>,
 *   conjunction: value-of<Conjunction>,
 * }
 */
final class NestedMeterFilter implements BaseModel
{
    /** @use SdkModel<nested_meter_filter> */
    use SdkModel;

    /**
     * Level 1: Can be conditions or nested filters (2 more levels allowed).
     *
     * @var list<Level1FilterCondition>|list<Level1NestedFilter> $clauses
     */
    #[Api(union: Clauses::class)]
    public array $clauses;

    /** @var value-of<Conjunction> $conjunction */
    #[Api(enum: Conjunction::class)]
    public string $conjunction;

    /**
     * `new NestedMeterFilter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NestedMeterFilter::with(clauses: ..., conjunction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NestedMeterFilter)->withClauses(...)->withConjunction(...)
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
     * @param list<Level1FilterCondition>|list<Level1NestedFilter> $clauses
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public static function with(
        array $clauses,
        Conjunction|string $conjunction
    ): self {
        $obj = new self;

        $obj->clauses = $clauses;
        $obj->conjunction = $conjunction instanceof Conjunction ? $conjunction->value : $conjunction;

        return $obj;
    }

    /**
     * Level 1: Can be conditions or nested filters (2 more levels allowed).
     *
     * @param list<Level1FilterCondition>|list<Level1NestedFilter> $clauses
     */
    public function withClauses(array $clauses): self
    {
        $obj = clone $this;
        $obj->clauses = $clauses;

        return $obj;
    }

    /**
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public function withConjunction(Conjunction|string $conjunction): self
    {
        $obj = clone $this;
        $obj->conjunction = $conjunction instanceof Conjunction ? $conjunction->value : $conjunction;

        return $obj;
    }
}
