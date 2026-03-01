<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditExpiredWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_EXPIRED = 'credit.expired';
}
