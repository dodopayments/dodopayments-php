<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Clause;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Conjunction;

/**
 * Level 3 nested filter (final nesting level).
 *
 * @phpstan-type level2_nested_filter = array{
 *   clauses: list<Clause>, conjunction: Conjunction::*
 * }
 */
final class Level2NestedFilter implements BaseModel
{
    /** @use SdkModel<level2_nested_filter> */
    use SdkModel;

    /**
     * Level 3: Filter conditions only (max depth reached).
     *
     * @var list<Clause> $clauses
     */
    #[Api(list: Clause::class)]
    public array $clauses;

    /** @var Conjunction::* $conjunction */
    #[Api(enum: Conjunction::class)]
    public string $conjunction;

    /**
     * `new Level2NestedFilter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Level2NestedFilter::with(clauses: ..., conjunction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Level2NestedFilter)->withClauses(...)->withConjunction(...)
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
     * @param list<Clause> $clauses
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
     * Level 3: Filter conditions only (max depth reached).
     *
     * @param list<Clause> $clauses
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
