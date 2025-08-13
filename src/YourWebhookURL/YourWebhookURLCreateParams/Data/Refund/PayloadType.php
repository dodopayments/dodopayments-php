<?php

declare(strict_types=1);

namespace DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type payload_type_alias = PayloadType::*
 */
final class PayloadType implements ConverterSource
{
    use Enum;

    public const REFUND = 'Refund';
}
