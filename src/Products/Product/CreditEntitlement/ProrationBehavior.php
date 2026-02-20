<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\CreditEntitlement;

/**
 * Proration behavior for credit grants during plan changes.
 */
enum ProrationBehavior: string
{
    case PRORATE = 'prorate';

    case NO_PRORATE = 'no_prorate';
}
