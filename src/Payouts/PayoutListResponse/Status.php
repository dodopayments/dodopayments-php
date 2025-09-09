<?php

declare(strict_types=1);

namespace Dodopayments\Payouts\PayoutListResponse;

/**
 * The current status of the payout.
 */
enum Status: string
{
    case NOT_INITIATED = 'not_initiated';

    case IN_PROGRESS = 'in_progress';

    case ON_HOLD = 'on_hold';

    case FAILED = 'failed';

    case SUCCESS = 'success';
}
