<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\CreditLedgerEntry;

enum PayloadType: string
{
    case CREDIT_LEDGER_ENTRY = 'CreditLedgerEntry';
}
