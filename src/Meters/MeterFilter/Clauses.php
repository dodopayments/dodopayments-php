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
