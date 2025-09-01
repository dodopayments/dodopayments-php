<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class Operator implements ConverterSource
{
    use SdkEnum;

    public const EQUALS = 'equals';

    public const NOT_EQUALS = 'not_equals';

    public const GREATER_THAN = 'greater_than';

    public const GREATER_THAN_OR_EQUALS = 'greater_than_or_equals';

    public const LESS_THAN = 'less_than';

    public const LESS_THAN_OR_EQUALS = 'less_than_or_equals';

    public const CONTAINS = 'contains';

    public const DOES_NOT_CONTAIN = 'does_not_contain';
}
