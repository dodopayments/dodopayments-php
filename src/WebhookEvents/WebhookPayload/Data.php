<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload;

use Dodopayments\Core\Concerns\Union;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription;

/**
 * The latest data at the time of delivery attempt.
 *
 * @phpstan-type data_alias = Payment|Subscription|Refund|Dispute|LicenseKey
 */
final class Data implements ConverterSource
{
    use Union;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [
            Payment::class,
            Subscription::class,
            Refund::class,
            Dispute::class,
            LicenseKey::class,
        ];
    }
}
