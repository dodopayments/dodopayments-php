<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\Refund;

enum PayloadType: string
{
    case REFUND = 'Refund';
}
