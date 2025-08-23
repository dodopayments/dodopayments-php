<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class PayloadType implements ConverterSource
{
    use SdkEnum;

    public const DISPUTE = 'Dispute';
}
