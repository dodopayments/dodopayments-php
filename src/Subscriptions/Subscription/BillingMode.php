<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\Subscription;

/**
 * `invoice_led` when invoices bill the subscription. `normal` otherwise.
 */
enum BillingMode: string
{
    case NORMAL = 'normal';

    case INVOICE_LED = 'invoice_led';
}
