<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition;

enum Operator: string
{
    case EQUALS = 'equals';

    case NOT_EQUALS = 'not_equals';

    case GREATER_THAN = 'greater_than';

    case GREATER_THAN_OR_EQUALS = 'greater_than_or_equals';

    case LESS_THAN = 'less_than';

    case LESS_THAN_OR_EQUALS = 'less_than_or_equals';

    case CONTAINS = 'contains';

    case DOES_NOT_CONTAIN = 'does_not_contain';
}
