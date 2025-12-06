<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeChallengedWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case DISPUTE_CHALLENGED = 'dispute.challenged';
}
