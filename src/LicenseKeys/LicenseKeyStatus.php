<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Concerns\Enum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type license_key_status_alias = LicenseKeyStatus::*
 */
final class LicenseKeyStatus implements ConverterSource
{
    use Enum;

    public const ACTIVE = 'active';

    public const EXPIRED = 'expired';

    public const DISABLED = 'disabled';
}
