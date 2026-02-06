<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams;

/**
 * Controls behavior when the plan change payment fails.
 * - `prevent_change`: Keep subscription on current plan until payment succeeds
 * - `apply_change` (default): Apply plan change immediately regardless of payment outcome.
 *
 * If not specified, uses the business-level default setting.
 */
enum OnPaymentFailure: string
{
    case PREVENT_CHANGE = 'prevent_change';

    case APPLY_CHANGE = 'apply_change';
}
