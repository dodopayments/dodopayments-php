<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeExpiredWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DISPUTE_EXPIRED = 'dispute.expired';
}
