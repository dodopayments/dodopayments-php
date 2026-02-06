<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\ThemeConfig;

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
