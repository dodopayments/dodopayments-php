<?php

declare(strict_types=1);

namespace Dodopayments\Refunds\RefundListParams;

/**
 * Filter by status.
 */
enum Status: string
{
    case SUCCEEDED = 'succeeded';

    case FAILED = 'failed';

    case PENDING = 'pending';

    case REVIEW = 'review';
}
