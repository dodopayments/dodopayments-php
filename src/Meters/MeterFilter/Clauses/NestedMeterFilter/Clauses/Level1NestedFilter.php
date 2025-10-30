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
 * @phpstan-type Level1NestedFilterShape = array{
 *   clauses: list<Level2FilterCondition>|list<Level2NestedFilter>,
 *   conjunction: value-of<Conjunction>,
 * }
 */
final class Level1NestedFilter implements BaseModel
{
    /** @use SdkModel<Level1NestedFilterShape> */
    use SdkModel;

    /**
     * Level 2: Can be conditions or nested filters (1 more level allowed).
     *
     * @var list<Level2FilterCondition>|list<Level2NestedFilter> $clauses
     */
    #[Api(union: Clauses::class)]
    public array $clauses;

    /** @var value-of<Conjunction> $conjunction */
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
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public static function with(
        array $clauses,
        Conjunction|string $conjunction
    ): self {
        $obj = new self;

        $obj->clauses = $clauses;
        $obj['conjunction'] = $conjunction;

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
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public function withConjunction(Conjunction|string $conjunction): self
    {
        $obj = clone $this;
        $obj['conjunction'] = $conjunction;

        return $obj;
    }
}
