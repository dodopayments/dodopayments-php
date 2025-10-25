<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionFailedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case SUBSCRIPTION_FAILED = 'subscription.failed';
}
