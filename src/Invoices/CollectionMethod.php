<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

enum CollectionMethod: string
{
    case AUTO_CHARGE = 'auto_charge';

    case MANUAL = 'manual';
}
