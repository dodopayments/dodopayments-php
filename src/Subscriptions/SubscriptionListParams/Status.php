<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionListParams;

/**
 * Filter by status.
 */
enum Status: string
{
    case PENDING = 'pending';

    case ACTIVE = 'active';

    case ON_HOLD = 'on_hold';

    case CANCELLED = 'cancelled';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
