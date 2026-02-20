<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\CreditBalanceLow;

enum PayloadType: string
{
    case CREDIT_BALANCE_LOW = 'CreditBalanceLow';
}
