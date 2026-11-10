<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionChangePlanParams;

/**
 * Where a downgrade credit goes. Only invoice-led subscriptions read it.
 * The default is `customer_balance`.
 */
enum Credit: string
{
    case CUSTOMER_BALANCE = 'customer_balance';

    case REFUND = 'refund';
}
