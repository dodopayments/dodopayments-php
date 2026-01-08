<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Conjunction;

/**
 * Level 1 nested filter - can contain Level 2 filters.
 *
 * @phpstan-import-type ClausesVariants from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses
 * @phpstan-import-type ClausesShape from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses
 *
 * @phpstan-type NestedMeterFilterShape = array{
 *   clauses: ClausesShape, conjunction: Conjunction|value-of<Conjunction>
 * }
 */
final class NestedMeterFilter implements BaseModel
{
    /** @use SdkModel<NestedMeterFilterShape> */
    use SdkModel;

    /**
     * Level 1: Can be conditions or nested filters (2 more levels allowed).
     *
     * @var ClausesVariants $clauses
     */
    #[Required(union: Clauses::class)]
    public array $clauses;

    /** @var value-of<Conjunction> $conjunction */
    #[Required(enum: Conjunction::class)]
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
     * Level 1: Can be conditions or nested filters (2 more levels allowed).
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
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public function withConjunction(Conjunction|string $conjunction): self
    {
        $self = clone $this;
        $self['conjunction'] = $conjunction;

        return $self;
    }
}
