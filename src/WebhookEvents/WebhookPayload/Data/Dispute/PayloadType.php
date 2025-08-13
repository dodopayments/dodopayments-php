<?php

declare(strict_types=1);

namespace DodoPayments\WebhookEvents\WebhookPayload\Data\Dispute;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type payload_type_alias = PayloadType::*
 */
final class PayloadType implements ConverterSource
{
    use Enum;

    public const DISPUTE = 'Dispute';
}
