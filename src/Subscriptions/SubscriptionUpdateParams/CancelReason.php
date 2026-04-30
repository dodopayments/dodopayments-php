<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdateParams;

enum CancelReason: string
{
    case CANCELLED_BY_CUSTOMER = 'cancelled_by_customer';

    case CANCELLED_BY_MERCHANT = 'cancelled_by_merchant';

    case CANCELLED_BY_MERCHANT_SEND_DUNNING = 'cancelled_by_merchant_send_dunning';

    case DODO_TEAM = 'dodo_team';
}
