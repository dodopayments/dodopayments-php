<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionUpdatedWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case SUBSCRIPTION_UPDATED = 'subscription.updated';
}
