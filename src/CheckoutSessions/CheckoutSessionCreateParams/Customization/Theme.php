<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Theme of the page.
 *
 * Default is `System`.
 */
final class Theme implements ConverterSource
{
    use SdkEnum;

    public const DARK = 'dark';

    public const LIGHT = 'light';

    public const SYSTEM = 'system';
}
