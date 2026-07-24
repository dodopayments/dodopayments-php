<?php

declare(strict_types=1);

namespace Dodopayments\Discounts\DiscountCreateParams;

/**
 * Who may redeem this discount code. Defaults to `any` (unrestricted).
 * `specific` starts with zero attached customers (fails closed) until
 * customers are attached via `POST /discounts/{id}/customers`.
 */
enum CustomerEligibility: string
{
    case ANY = 'any';

    case FIRST_TIME = 'first_time';

    case EXISTING = 'existing';

    case SPECIFIC = 'specific';
}
