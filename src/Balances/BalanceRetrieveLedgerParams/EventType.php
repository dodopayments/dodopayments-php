<?php

declare(strict_types=1);

namespace Dodopayments\Balances\BalanceRetrieveLedgerParams;

/**
 * Filter by Ledger Event Type.
 */
enum EventType: string
{
    case PAYMENT = 'payment';

    case REFUND = 'refund';

    case REFUND_REVERSAL = 'refund_reversal';

    case DISPUTE = 'dispute';

    case DISPUTE_REVERSAL = 'dispute_reversal';

    case TAX = 'tax';

    case TAX_REVERSAL = 'tax_reversal';

    case PAYMENT_FEES = 'payment_fees';

    case REFUND_FEES = 'refund_fees';

    case REFUND_FEES_REVERSAL = 'refund_fees_reversal';

    case DISPUTE_FEES = 'dispute_fees';

    case PAYOUT = 'payout';

    case PAYOUT_FEES = 'payout_fees';

    case PAYOUT_REVERSAL = 'payout_reversal';

    case PAYOUT_FEES_REVERSAL = 'payout_fees_reversal';

    case DODO_CREDITS = 'dodo_credits';

    case ADJUSTMENT = 'adjustment';

    case CURRENCY_CONVERSION = 'currency_conversion';
}
