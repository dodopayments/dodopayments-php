<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

/**
 * The `message` of each variant is the label of the invoice document.
 */
enum InvoiceStatus: string
{
    case OPEN = 'open';

    case PAID = 'paid';

    case VOID = 'void';

    case DRAFT = 'draft';

    case PAST_DUE = 'past_due';

    case UNCOLLECTABLE = 'uncollectable';
}
