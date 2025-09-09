<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

enum SubscriptionStatus: string
{
    case PENDING = 'pending';

    case ACTIVE = 'active';

    case ON_HOLD = 'on_hold';

    case CANCELLED = 'cancelled';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
