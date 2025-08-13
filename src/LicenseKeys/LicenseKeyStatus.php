<?php

declare(strict_types=1);

namespace DodopaymentsClient\LicenseKeys;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

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
