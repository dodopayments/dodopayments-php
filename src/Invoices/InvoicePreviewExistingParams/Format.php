<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoicePreviewExistingParams;

/**
 * The preview body. `json` returns the invoice JSON. `pdf` returns the PDF with a draft mark.
 * `email` returns the HTML of the invoice email. A preview saves no row.
 */
enum Format: string
{
    case JSON = 'json';

    case PDF = 'pdf';

    case EMAIL = 'email';
}
