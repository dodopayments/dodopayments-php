<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\AbandonedCheckout;

enum PayloadType: string
{
    case ABANDONED_CHECKOUT = 'AbandonedCheckout';
}
