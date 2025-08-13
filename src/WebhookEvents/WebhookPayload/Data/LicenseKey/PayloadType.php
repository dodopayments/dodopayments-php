<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;

use Dodopayments\Core\Concerns\Enum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type payload_type_alias = PayloadType::*
 */
final class PayloadType implements ConverterSource
{
    use Enum;

    public const LICENSE_KEY = 'LicenseKey';
}
