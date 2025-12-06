<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionFailedWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case SUBSCRIPTION_FAILED = 'subscription.failed';
}
