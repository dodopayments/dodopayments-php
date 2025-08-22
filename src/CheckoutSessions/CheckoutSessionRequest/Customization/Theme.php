<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest\Customization;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Theme of the page.
 *
 * Default is `System`.
 *
 * @phpstan-type theme_alias = Theme::*
 */
final class Theme implements ConverterSource
{
    use SdkEnum;

    public const DARK = 'dark';

    public const LIGHT = 'light';

    public const SYSTEM = 'system';
}
