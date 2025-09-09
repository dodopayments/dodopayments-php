<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription;

enum PayloadType: string
{
    case SUBSCRIPTION = 'Subscription';
}
