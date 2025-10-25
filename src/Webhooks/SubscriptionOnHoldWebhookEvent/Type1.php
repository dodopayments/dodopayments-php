<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionOnHoldWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case SUBSCRIPTION_ON_HOLD = 'subscription.on_hold';
}
