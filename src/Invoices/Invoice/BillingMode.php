<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

enum BillingMode: string
{
    case NORMAL = 'normal';

    case INVOICE_LED = 'invoice_led';
}
