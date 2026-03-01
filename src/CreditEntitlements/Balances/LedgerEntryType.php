<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

enum LedgerEntryType: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';
}
