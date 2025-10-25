<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeLostWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DISPUTE_LOST = 'dispute.lost';
}
