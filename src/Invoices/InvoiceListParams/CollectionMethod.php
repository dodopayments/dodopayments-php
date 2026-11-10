<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceListParams;

enum CollectionMethod: string
{
    case AUTO_CHARGE = 'auto_charge';

    case MANUAL = 'manual';
}
