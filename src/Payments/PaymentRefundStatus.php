<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

enum PaymentRefundStatus: string
{
    case PARTIAL = 'partial';

    case FULL = 'full';
}
