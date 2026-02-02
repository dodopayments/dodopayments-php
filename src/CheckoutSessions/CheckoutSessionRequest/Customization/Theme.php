<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest\Customization;

/**
 * Theme of the page (determines which mode - light/dark/system - to use).
 *
 * Default is `System`.
 */
enum Theme: string
{
    case DARK = 'dark';

    case LIGHT = 'light';

    case SYSTEM = 'system';
}
