<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionRenewedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case SUBSCRIPTION_RENEWED = 'subscription.renewed';
}
