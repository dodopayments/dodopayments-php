<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

enum Tag: string
{
    case REFUNDED = 'refunded';

    case PARTIALLY_REFUNDED = 'partially_refunded';

    case DISPUTED = 'disputed';

    case PAYMENT_REVERSED = 'payment_reversed';
}
