<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\Payment;

enum PayloadType: string
{
    case PAYMENT = 'Payment';
}
