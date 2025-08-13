<?php

declare(strict_types=1);

namespace DodopaymentsClient\Refunds\RefundListParams;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by status.
 *
 * @phpstan-type status_alias = Status::*
 */
final class Status implements ConverterSource
{
    use Enum;

    public const SUCCEEDED = 'succeeded';

    public const FAILED = 'failed';

    public const PENDING = 'pending';

    public const REVIEW = 'review';
}
