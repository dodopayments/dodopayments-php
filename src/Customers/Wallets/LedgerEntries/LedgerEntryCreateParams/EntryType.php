<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams;

/**
 * Type of ledger entry - credit or debit.
 */
enum EntryType: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';
}
