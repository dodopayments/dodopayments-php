<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\CreditLedgerEntry;

enum TransactionType: string
{
    case CREDIT_ADDED = 'credit_added';

    case CREDIT_DEDUCTED = 'credit_deducted';

    case CREDIT_EXPIRED = 'credit_expired';

    case CREDIT_ROLLED_OVER = 'credit_rolled_over';

    case ROLLOVER_FORFEITED = 'rollover_forfeited';

    case OVERAGE_CHARGED = 'overage_charged';

    case AUTO_TOP_UP = 'auto_top_up';

    case MANUAL_ADJUSTMENT = 'manual_adjustment';

    case REFUND = 'refund';
}
