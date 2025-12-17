<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter;

/**
 * Level 1: Can be conditions or nested filters (2 more levels allowed).
 *
 * @phpstan-import-type Level1FilterConditionShape from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition
 * @phpstan-import-type Level1NestedFilterShape from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter
 *
 * @phpstan-type ClausesShape = list<Level1FilterConditionShape>|list<Level1NestedFilterShape>
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
            new ListOf(Level1FilterCondition::class),
            new ListOf(Level1NestedFilter::class),
        ];
    }
}
