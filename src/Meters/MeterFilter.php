<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter;
use Dodopayments\Meters\MeterFilter\Conjunction;

/**
 * A filter structure that combines multiple conditions with logical conjunctions (AND/OR).
 *
 * Supports up to 3 levels of nesting to create complex filter expressions.
 * Each filter has a conjunction (and/or) and clauses that can be either direct conditions or nested filters.
 *
 * @phpstan-import-type ClausesShape from \Dodopayments\Meters\MeterFilter\Clauses
 *
 * @phpstan-type MeterFilterShape = array{
 *   clauses: ClausesShape, conjunction: Conjunction|value-of<Conjunction>
 * }
 */
final class MeterFilter implements BaseModel
{
    /** @use SdkModel<MeterFilterShape> */
    use SdkModel;

    /**
     * Filter clauses - can be direct conditions or nested filters (up to 3 levels deep).
     *
     * @var list<DirectFilterCondition>|list<NestedMeterFilter> $clauses
     */
    #[Required(union: Clauses::class)]
    public array $clauses;

    /**
     * Logical conjunction to apply between clauses (and/or).
     *
     * @var value-of<Conjunction> $conjunction
     */
    #[Required(enum: Conjunction::class)]
    public string $conjunction;

    /**
     * `new MeterFilter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MeterFilter::with(clauses: ..., conjunction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MeterFilter)->withClauses(...)->withConjunction(...)
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
     * @param ClausesShape $clauses
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
     * Filter clauses - can be direct conditions or nested filters (up to 3 levels deep).
     *
     * @param ClausesShape $clauses
     */
    public function withClauses(array $clauses): self
    {
        $self = clone $this;
        $self['clauses'] = $clauses;

        return $self;
    }

    /**
     * Logical conjunction to apply between clauses (and/or).
     *
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public function withConjunction(Conjunction|string $conjunction): self
    {
        $self = clone $this;
        $self['conjunction'] = $conjunction;

        return $self;
    }
}
