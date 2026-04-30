<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\Subscription;

/**
 * Customer-supplied churn reason, if any.
 */
enum CancellationFeedback: string
{
    case TOO_EXPENSIVE = 'too_expensive';

    case MISSING_FEATURES = 'missing_features';

    case SWITCHED_SERVICE = 'switched_service';

    case UNUSED = 'unused';

    case CUSTOMER_SERVICE = 'customer_service';

    case LOW_QUALITY = 'low_quality';

    case TOO_COMPLEX = 'too_complex';

    case OTHER = 'other';
}
