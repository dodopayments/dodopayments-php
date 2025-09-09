<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionChangePlanParams;

/**
 * Proration Billing Mode.
 */
enum ProrationBillingMode: string
{
    case PRORATED_IMMEDIATELY = 'prorated_immediately';

    case FULL_IMMEDIATELY = 'full_immediately';

    case DIFFERENCE_IMMEDIATELY = 'difference_immediately';
}
