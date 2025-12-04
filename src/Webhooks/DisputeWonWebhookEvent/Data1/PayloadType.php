<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeWonWebhookEvent\Data1;

/**
 * The type of payload in the data field.
 */
enum PayloadType: string
{
    case DISPUTE = 'Dispute';
}
