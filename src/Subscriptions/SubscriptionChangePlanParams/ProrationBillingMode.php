<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionChangePlanParams;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Proration Billing Mode.
 */
final class ProrationBillingMode implements ConverterSource
{
    use SdkEnum;

    public const PRORATED_IMMEDIATELY = 'prorated_immediately';

    public const FULL_IMMEDIATELY = 'full_immediately';

    public const DIFFERENCE_IMMEDIATELY = 'difference_immediately';
}
