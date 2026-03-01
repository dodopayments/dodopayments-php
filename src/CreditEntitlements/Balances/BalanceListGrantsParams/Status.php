<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances\BalanceListGrantsParams;

/**
 * Filter by grant status: active, expired, depleted.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case EXPIRED = 'expired';

    case DEPLETED = 'depleted';
}
