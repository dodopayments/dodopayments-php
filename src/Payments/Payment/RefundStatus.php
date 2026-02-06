<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment;

/**
 * Summary of the refund status for this payment. None if no succeeded refunds exist.
 */
enum RefundStatus: string
{
    case PARTIAL = 'partial';

    case FULL = 'full';
}
