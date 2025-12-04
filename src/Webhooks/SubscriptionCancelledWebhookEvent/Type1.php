<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionCancelledWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case SUBSCRIPTION_CANCELLED = 'subscription.cancelled';
}
