<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCustomization;

/**
 * Theme of the page (determines which mode - light/dark/system - to use).
 *
 * If not provided, uses the business-configured theme from business_themes table.
 */
enum Theme: string
{
    case DARK = 'dark';

    case LIGHT = 'light';

    case SYSTEM = 'system';
}
