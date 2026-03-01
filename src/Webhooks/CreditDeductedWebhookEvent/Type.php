<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditDeductedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_DEDUCTED = 'credit.deducted';
}
