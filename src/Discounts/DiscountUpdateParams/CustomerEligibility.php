<?php

declare(strict_types=1);

namespace Dodopayments\Discounts\DiscountUpdateParams;

/**
 * If present, update who may redeem this discount. Plain field (not
 * double-option): the DB column is `NOT NULL`, so it can never be cleared
 * back to unset, only changed to another `CustomerEligibility` value.
 */
enum CustomerEligibility: string
{
    case ANY = 'any';

    case FIRST_TIME = 'first_time';

    case EXISTING = 'existing';

    case SPECIFIC = 'specific';
}
