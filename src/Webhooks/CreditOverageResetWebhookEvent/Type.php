<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditOverageResetWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_OVERAGE_RESET = 'credit.overage_reset';
}
