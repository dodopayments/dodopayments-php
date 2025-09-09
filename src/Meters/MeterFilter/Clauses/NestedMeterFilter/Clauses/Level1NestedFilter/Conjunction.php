<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter;

enum Conjunction: string
{
    case AND = 'and';

    case OR = 'or';
}
