<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeOpenedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DISPUTE_OPENED = 'dispute.opened';
}
