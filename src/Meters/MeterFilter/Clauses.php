<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter;

/**
 * Filter clauses - can be direct conditions or nested filters (up to 3 levels deep).
 *
 * @phpstan-import-type DirectFilterConditionShape from \Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition
 * @phpstan-import-type NestedMeterFilterShape from \Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter
 *
 * @phpstan-type ClausesVariants = list<DirectFilterCondition>|list<NestedMeterFilter>
 * @phpstan-type ClausesShape = ClausesVariants|list<DirectFilterConditionShape>|list<NestedMeterFilterShape>
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
            new ListOf(DirectFilterCondition::class),
            new ListOf(NestedMeterFilter::class),
        ];
    }
}
