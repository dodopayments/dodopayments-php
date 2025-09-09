<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter;

/**
 * Logical conjunction to apply between clauses (and/or).
 */
enum Conjunction: string
{
    case AND = 'and';

    case OR = 'or';
}
