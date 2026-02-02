<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\ThemeConfig;

/**
 * Font size for the checkout UI.
 */
enum FontSize: string
{
    case XS = 'xs';

    case SM = 'sm';

    case MD = 'md';

    case LG = 'lg';

    case XL = 'xl';

    case _2XL = '2xl';
}
