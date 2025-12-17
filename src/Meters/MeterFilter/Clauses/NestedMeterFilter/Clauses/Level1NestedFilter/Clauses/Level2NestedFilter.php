<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Clause;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Conjunction;

/**
 * Level 3 nested filter (final nesting level).
 *
 * @phpstan-import-type ClauseShape from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Clause
 *
 * @phpstan-type Level2NestedFilterShape = array{
 *   clauses: list<ClauseShape>, conjunction: Conjunction|value-of<Conjunction>
 * }
 */
final class Level2NestedFilter implements BaseModel
{
    /** @use SdkModel<Level2NestedFilterShape> */
    use SdkModel;

    /**
     * Level 3: Filter conditions only (max depth reached).
     *
     * @var list<Clause> $clauses
     */
    #[Required(list: Clause::class)]
    public array $clauses;

    /** @var value-of<Conjunction> $conjunction */
    #[Required(enum: Conjunction::class)]
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
     * @param list<ClauseShape> $clauses
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public static function with(
        array $clauses,
        Conjunction|string $conjunction
    ): self {
        $self = new self;

        $self['clauses'] = $clauses;
        $self['conjunction'] = $conjunction;

        return $self;
    }

    /**
     * Level 3: Filter conditions only (max depth reached).
     *
     * @param list<ClauseShape> $clauses
     */
    public function withClauses(array $clauses): self
    {
        $self = clone $this;
        $self['clauses'] = $clauses;

        return $self;
    }

    /**
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public function withConjunction(Conjunction|string $conjunction): self
    {
        $self = clone $this;
        $self['conjunction'] = $conjunction;

        return $self;
    }
}
