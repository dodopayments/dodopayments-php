<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2FilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter;

/**
 * Level 2: Can be conditions or nested filters (1 more level allowed).
 *
 * @phpstan-import-type Level2FilterConditionShape from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2FilterCondition
 * @phpstan-import-type Level2NestedFilterShape from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter
 *
 * @phpstan-type ClausesVariants = list<Level2FilterCondition>|list<Level2NestedFilter>
 * @phpstan-type ClausesShape = ClausesVariants|list<Level2FilterConditionShape>|list<Level2NestedFilterShape>
 */
final class Clauses implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            new ListOf(Level2FilterCondition::class),
            new ListOf(Level2NestedFilter::class),
        ];
    }
}
