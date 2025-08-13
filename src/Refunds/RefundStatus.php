<?php

declare(strict_types=1);

namespace DodoPayments\Refunds;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type refund_status_alias = RefundStatus::*
 */
final class RefundStatus implements ConverterSource
{
    use Enum;

    public const SUCCEEDED = 'succeeded';

    public const FAILED = 'failed';

    public const PENDING = 'pending';

    public const REVIEW = 'review';
}
