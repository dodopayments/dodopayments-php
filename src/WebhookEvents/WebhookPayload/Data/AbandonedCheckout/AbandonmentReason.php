<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\AbandonedCheckout;

enum AbandonmentReason: string
{
    case PAYMENT_FAILED = 'payment_failed';

    case CHECKOUT_INCOMPLETE = 'checkout_incomplete';
}
