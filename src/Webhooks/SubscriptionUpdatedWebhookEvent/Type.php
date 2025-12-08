<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionUpdatedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case SUBSCRIPTION_UPDATED = 'subscription.updated';
}
