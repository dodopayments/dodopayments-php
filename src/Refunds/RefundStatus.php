<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

enum RefundStatus: string
{
    case SUCCEEDED = 'succeeded';

    case FAILED = 'failed';

    case PENDING = 'pending';

    case REVIEW = 'review';
}
