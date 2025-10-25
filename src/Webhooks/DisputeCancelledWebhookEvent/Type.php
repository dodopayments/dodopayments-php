<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeCancelledWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DISPUTE_CANCELLED = 'dispute.cancelled';
}
