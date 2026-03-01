<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditRolloverForfeitedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_ROLLOVER_FORFEITED = 'credit.rollover_forfeited';
}
