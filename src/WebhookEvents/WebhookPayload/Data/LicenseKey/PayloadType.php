<?php

declare(strict_types=1);

namespace DodopaymentsClient\WebhookEvents\WebhookPayload\Data\LicenseKey;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type payload_type_alias = PayloadType::*
 */
final class PayloadType implements ConverterSource
{
    use Enum;

    public const LICENSE_KEY = 'LicenseKey';
}
