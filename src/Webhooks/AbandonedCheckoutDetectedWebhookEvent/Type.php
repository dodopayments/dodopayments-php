<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\AbandonedCheckoutDetectedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case ABANDONED_CHECKOUT_DETECTED = 'abandoned_checkout.detected';
}
