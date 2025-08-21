<?php

declare(strict_types=1);

namespace Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type payload_type_alias = PayloadType::*
 */
final class PayloadType implements ConverterSource
{
    use SdkEnum;

    public const SUBSCRIPTION = 'Subscription';
}
