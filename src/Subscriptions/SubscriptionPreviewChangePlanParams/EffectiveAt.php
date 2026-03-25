<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams;

/**
 * When to apply the plan change.
 * - `immediately` (default): Apply the plan change right away
 * - `next_billing_date`: Schedule the change for the next billing date.
 */
enum EffectiveAt: string
{
    case IMMEDIATELY = 'immediately';

    case NEXT_BILLING_DATE = 'next_billing_date';
}
