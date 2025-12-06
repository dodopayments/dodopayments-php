<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionRenewedWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case SUBSCRIPTION_RENEWED = 'subscription.renewed';
}
