<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * A filter structure that combines multiple conditions with logical conjunctions (AND/OR).
 *
 * Supports up to 3 levels of nesting to create complex filter expressions.
 * Each filter has a conjunction (and/or) and clauses that can be either direct conditions or nested filters.
 *
 * @phpstan-type MeterFilterShape = array{
 *   clauses: mixed, conjunction: Conjunction|value-of<Conjunction>
 * }
 */
final class MeterFilter implements BaseModel
{
    /** @use SdkModel<MeterFilterShape> */
    use SdkModel;

    /**
     * Filter clauses - can be direct conditions or nested filters (up to 3 levels deep).
     */
    #[Required(union: FilterType::class)]
    public mixed $clauses;

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
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public static function with(
        mixed $clauses,
        Conjunction|string $conjunction
    ): self {
        $self = new self;

        $self['clauses'] = $clauses;
        $self['conjunction'] = $conjunction;

        return $self;
    }

    /**
     * Filter clauses - can be direct conditions or nested filters (up to 3 levels deep).
     */
    public function withClauses(mixed $clauses): self
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
