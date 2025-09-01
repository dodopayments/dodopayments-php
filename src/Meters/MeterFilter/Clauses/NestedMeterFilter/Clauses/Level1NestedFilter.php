<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2FilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Conjunction;

/**
 * Level 2 nested filter.
 *
 * @phpstan-type level1_nested_filter = array{
 *   clauses: list<Level2FilterCondition>|list<Level2NestedFilter>,
 *   conjunction: Conjunction::*,
 * }
 */
final class Level1NestedFilter implements BaseModel
{
    /** @use SdkModel<level1_nested_filter> */
    use SdkModel;

    /**
     * Level 2: Can be conditions or nested filters (1 more level allowed).
     *
     * @var list<Level2FilterCondition>|list<Level2NestedFilter> $clauses
     */
    #[Api(union: Clauses::class)]
    public array $clauses;

    /** @var Conjunction::* $conjunction */
    #[Api(enum: Conjunction::class)]
    public string $conjunction;

    /**
     * `new Level1NestedFilter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Level1NestedFilter::with(clauses: ..., conjunction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Level1NestedFilter)->withClauses(...)->withConjunction(...)
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
     * @param list<Level2FilterCondition>|list<Level2NestedFilter> $clauses
     * @param Conjunction::* $conjunction
     */
    public static function with(array $clauses, string $conjunction): self
    {
        $obj = new self;

        $obj->clauses = $clauses;
        $obj->conjunction = $conjunction;

        return $obj;
    }

    /**
     * Level 2: Can be conditions or nested filters (1 more level allowed).
     *
     * @param list<Level2FilterCondition>|list<Level2NestedFilter> $clauses
     */
    public function withClauses(array $clauses): self
    {
        $obj = clone $this;
        $obj->clauses = $clauses;

        return $obj;
    }

    /**
     * @param Conjunction::* $conjunction
     */
    public function withConjunction(string $conjunction): self
    {
        $obj = clone $this;
        $obj->conjunction = $conjunction;

        return $obj;
    }
}
