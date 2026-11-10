<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

/**
 * An action that a merchant can request on the invoice in its current status.
 */
enum AllowedAction: string
{
    case EDIT = 'edit';

    case FINALIZE = 'finalize';

    case DELETE = 'delete';

    case SEND = 'send';

    case RETRY = 'retry';

    case VOID = 'void';

    case MARK_UNCOLLECTABLE = 'mark_uncollectable';

    case CHANGE_DUNNING = 'change_dunning';

    case ADD_NOTE = 'add_note';

    case DUPLICATE = 'duplicate';
}
