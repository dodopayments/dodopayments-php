<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionChangePlanParams;

use Dodopayments\Core\Concerns\Enum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Proration Billing Mode.
 *
 * @phpstan-type proration_billing_mode_alias = ProrationBillingMode::*
 */
final class ProrationBillingMode implements ConverterSource
{
    use Enum;

    public const PRORATED_IMMEDIATELY = 'prorated_immediately';

    public const FULL_IMMEDIATELY = 'full_immediately';

    public const DIFFERENCE_IMMEDIATELY = 'difference_immediately';
}
