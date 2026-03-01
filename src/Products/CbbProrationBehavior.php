<?php

declare(strict_types=1);

namespace Dodopayments\Products;

enum CbbProrationBehavior: string
{
    case PRORATE = 'prorate';

    case NO_PRORATE = 'no_prorate';
}
