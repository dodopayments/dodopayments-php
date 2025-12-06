<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeOpenedWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case DISPUTE_OPENED = 'dispute.opened';
}
