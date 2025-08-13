<?php

declare(strict_types=1);

namespace DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type payload_type_alias = PayloadType::*
 */
final class PayloadType implements ConverterSource
{
    use Enum;

    public const SUBSCRIPTION = 'Subscription';
}
