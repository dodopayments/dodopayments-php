<?php

declare(strict_types=1);

namespace DodopaymentsClient\Subscriptions\SubscriptionChangePlanParams;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

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
