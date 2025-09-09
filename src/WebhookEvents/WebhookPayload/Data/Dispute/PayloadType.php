<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;

enum PayloadType: string
{
    case DISPUTE = 'Dispute';
}
