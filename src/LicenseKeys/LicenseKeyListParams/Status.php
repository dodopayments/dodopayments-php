<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys\LicenseKeyListParams;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by license key status.
 */
final class Status implements ConverterSource
{
    use SdkEnum;

    public const ACTIVE = 'active';

    public const EXPIRED = 'expired';

    public const DISABLED = 'disabled';
}
