<?php

declare(strict_types=1);

namespace DodoPayments\Responses\Payouts\PayoutListResponse;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * The current status of the payout.
 *
 * @phpstan-type status_alias = Status::*
 */
final class Status implements ConverterSource
{
    use Enum;

    public const NOT_INITIATED = 'not_initiated';

    public const IN_PROGRESS = 'in_progress';

    public const ON_HOLD = 'on_hold';

    public const FAILED = 'failed';

    public const SUCCESS = 'success';
}
