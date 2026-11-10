<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCustomization;

/**
 * How a single-page checkout shows the payment methods. You can set it only
 * when `feature_flags.single_page` is true.
 *
 * Default is `accordion`.
 */
enum PaymentMethodLayout: string
{
    case ACCORDION = 'accordion';

    case TABS = 'tabs';
}
