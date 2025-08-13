<?php

declare(strict_types=1);

namespace DodopaymentsClient\Subscriptions\SubscriptionListParams;

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

    public const PENDING = 'pending';

    public const ACTIVE = 'active';

    public const ON_HOLD = 'on_hold';

    public const CANCELLED = 'cancelled';

    public const FAILED = 'failed';

    public const EXPIRED = 'expired';
}
