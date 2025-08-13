<?php

declare(strict_types=1);

namespace DodopaymentsClient\Refunds;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

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
