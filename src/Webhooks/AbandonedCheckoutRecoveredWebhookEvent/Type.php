<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\AbandonedCheckoutRecoveredWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case ABANDONED_CHECKOUT_RECOVERED = 'abandoned_checkout.recovered';
}
