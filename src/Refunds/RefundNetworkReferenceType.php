<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

/**
 * The kind of reference number that the card network or the bank gives to a refund.
 */
enum RefundNetworkReferenceType: string
{
    case ACQUIRER_REFERENCE_NUMBER = 'acquirer_reference_number';

    case SYSTEM_TRACE_AUDIT_NUMBER = 'system_trace_audit_number';

    case RETRIEVAL_REFERENCE_NUMBER = 'retrieval_reference_number';

    case OTHER = 'other';
}
