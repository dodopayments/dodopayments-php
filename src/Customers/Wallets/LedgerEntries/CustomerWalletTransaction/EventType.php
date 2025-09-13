<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;

enum EventType: string
{
    case PAYMENT = 'payment';

    case PAYMENT_REVERSAL = 'payment_reversal';

    case REFUND = 'refund';

    case REFUND_REVERSAL = 'refund_reversal';

    case DISPUTE = 'dispute';

    case DISPUTE_REVERSAL = 'dispute_reversal';

    case MERCHANT_ADJUSTMENT = 'merchant_adjustment';
}
