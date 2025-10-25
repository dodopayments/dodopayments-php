<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\SubscriptionRenewedWebhookEvent\Data;

/**
 * The type of payload in the data field.
 */
enum PayloadType: string
{
    case SUBSCRIPTION = 'Subscription';
}
