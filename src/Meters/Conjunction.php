<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

enum Conjunction: string
{
    case AND = 'and';

    case OR = 'or';
}
