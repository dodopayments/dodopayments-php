<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Meters\MeterFilter\Clauses;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition\Operator;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter;
use Dodopayments\Meters\MeterFilter\Conjunction;

/**
 * A filter structure that combines multiple conditions with logical conjunctions (AND/OR).
 *
 * Supports up to 3 levels of nesting to create complex filter expressions.
 * Each filter has a conjunction (and/or) and clauses that can be either direct conditions or nested filters.
 *
 * @phpstan-type MeterFilterShape = array{
 *   clauses: list<DirectFilterCondition>|list<NestedMeterFilter>,
 *   conjunction: value-of<Conjunction>,
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
     * @param list<DirectFilterCondition|array{
     *   key: string, operator: value-of<Operator>, value: string|float|bool
     * }>|list<NestedMeterFilter|array{
     *   clauses: list<Level1FilterCondition>|list<Level1NestedFilter>,
     *   conjunction: value-of<NestedMeterFilter\Conjunction>,
     * }> $clauses
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public static function with(
        array $clauses,
        Conjunction|string $conjunction
    ): self {
        $obj = new self;

        $obj['clauses'] = $clauses;
        $obj['conjunction'] = $conjunction;

        return $obj;
    }

    /**
     * Filter clauses - can be direct conditions or nested filters (up to 3 levels deep).
     *
     * @param list<DirectFilterCondition|array{
     *   key: string, operator: value-of<Operator>, value: string|float|bool
     * }>|list<NestedMeterFilter|array{
     *   clauses: list<Level1FilterCondition>|list<Level1NestedFilter>,
     *   conjunction: value-of<NestedMeterFilter\Conjunction>,
     * }> $clauses
     */
    public function withClauses(array $clauses): self
    {
        $obj = clone $this;
        $obj['clauses'] = $clauses;

        return $obj;
    }

    /**
     * Logical conjunction to apply between clauses (and/or).
     *
     * @param Conjunction|value-of<Conjunction> $conjunction
     */
    public function withConjunction(Conjunction|string $conjunction): self
    {
        $obj = clone $this;
        $obj['conjunction'] = $conjunction;

        return $obj;
    }
}
