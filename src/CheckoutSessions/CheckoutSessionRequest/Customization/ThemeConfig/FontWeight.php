<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest\Customization\ThemeConfig;

/**
 * Font weight for the checkout UI.
 */
enum FontWeight: string
{
    case NORMAL = 'normal';

    case MEDIUM = 'medium';

    case BOLD = 'bold';

    case EXTRA_BOLD = 'extraBold';
}
