<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Meters\FilterType\MeterFilterConditionList;

/**
 * Filter clauses — either a flat list of `MeterFilterCondition`s or a list of nested `MeterFilter`s. Up to 3 levels of nesting are accepted; the limit is enforced at runtime.
 *
 * @phpstan-import-type MeterFilterConditionListShape from \Dodopayments\Meters\FilterType\MeterFilterConditionList
 * @phpstan-import-type MeterFilterShape from \Dodopayments\Meters\MeterFilter
 *
 * @phpstan-type FilterTypeVariants = list<MeterFilterConditionList>|list<mixed>
 * @phpstan-type FilterTypeShape = FilterTypeVariants|list<MeterFilterConditionListShape>|list<MeterFilterShape>
 */
final class FilterType implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            new ListOf(MeterFilterConditionList::class),
            new ListOf(MeterFilter::class),
        ];
    }
}
