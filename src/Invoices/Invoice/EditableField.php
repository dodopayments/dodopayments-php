<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

enum EditableField: string
{
    case CUSTOMER = 'customer';

    case ITEMS = 'items';

    case DISCOUNTS = 'discounts';

    case CURRENCY = 'currency';

    case BILLING_ADDRESS = 'billing_address';

    case TAX_ID = 'tax_id';

    case REVIEW_REQUIRED = 'review_required';

    case DUE_AT = 'due_at';

    case COLLECTION_METHOD = 'collection_method';

    case MEMO = 'memo';

    case CUSTOMER_EMAIL = 'customer_email';

    case CC_EMAILS = 'cc_emails';

    case DUNNING = 'dunning';

    case METADATA = 'metadata';
}
