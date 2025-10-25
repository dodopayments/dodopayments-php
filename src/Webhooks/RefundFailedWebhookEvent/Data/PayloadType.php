<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\RefundFailedWebhookEvent\Data;

/**
 * The type of payload in the data field.
 */
enum PayloadType: string
{
    case REFUND = 'Refund';
}
