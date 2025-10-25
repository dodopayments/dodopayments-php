<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionExpiredWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case SUBSCRIPTION_EXPIRED = 'subscription.expired';
}
