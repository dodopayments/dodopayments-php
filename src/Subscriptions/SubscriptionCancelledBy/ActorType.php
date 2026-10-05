<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionCancelledBy;

/**
 * The kind of caller.
 */
enum ActorType: string
{
    case CUSTOMER = 'customer';

    case MERCHANT_USER = 'merchant_user';

    case API_KEY = 'api_key';

    case DODO_TEAM = 'dodo_team';
}
