<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditAddedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_ADDED = 'credit.added';
}
