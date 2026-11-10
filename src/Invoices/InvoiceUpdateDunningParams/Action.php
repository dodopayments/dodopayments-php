<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceUpdateDunningParams;

enum Action: string
{
    case PAUSE = 'pause';

    case RESUME = 'resume';

    case RESCHEDULE = 'reschedule';
}
