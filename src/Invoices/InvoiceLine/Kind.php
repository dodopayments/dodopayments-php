<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceLine;

enum Kind: string
{
    case SUBSCRIPTION = 'subscription';

    case ADDON = 'addon';

    case METER = 'meter';

    case CREDIT_OVERAGE = 'credit_overage';

    case ONE_TIME = 'one_time';
}
