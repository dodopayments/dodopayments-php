<?php

declare(strict_types=1);

namespace Dodopayments\Discounts\Discount;

/**
 * Who may redeem this discount code.
 */
enum CustomerEligibility: string
{
    case ANY = 'any';

    case FIRST_TIME = 'first_time';

    case EXISTING = 'existing';

    case SPECIFIC = 'specific';
}
