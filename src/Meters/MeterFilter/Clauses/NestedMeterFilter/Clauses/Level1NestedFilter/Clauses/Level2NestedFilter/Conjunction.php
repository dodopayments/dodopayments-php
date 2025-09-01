<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class Conjunction implements ConverterSource
{
    use SdkEnum;

    public const AND = 'and';

    public const OR = 'or';
}
