<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionPlanChangedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case SUBSCRIPTION_PLAN_CHANGED = 'subscription.plan_changed';
}
