<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionListParams;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by status.
 *
 * @phpstan-type status_alias = Status::*
 */
final class Status implements ConverterSource
{
    use SdkEnum;

    public const PENDING = 'pending';

    public const ACTIVE = 'active';

    public const ON_HOLD = 'on_hold';

    public const CANCELLED = 'cancelled';

    public const FAILED = 'failed';

    public const EXPIRED = 'expired';
}
