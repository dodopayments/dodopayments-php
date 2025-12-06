<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionActiveWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case SUBSCRIPTION_ACTIVE = 'subscription.active';
}
