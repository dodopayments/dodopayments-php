<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeCancelledWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case DISPUTE_CANCELLED = 'dispute.cancelled';
}
