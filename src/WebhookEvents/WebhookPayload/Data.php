<?php

declare(strict_types=1);

namespace DodoPayments\WebhookEvents\WebhookPayload;

use DodoPayments\Core\Concerns\Union;
use DodoPayments\Core\Conversion\Contracts\Converter;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;
use DodoPayments\WebhookEvents\WebhookPayload\Data\Dispute;
use DodoPayments\WebhookEvents\WebhookPayload\Data\LicenseKey;
use DodoPayments\WebhookEvents\WebhookPayload\Data\Payment;
use DodoPayments\WebhookEvents\WebhookPayload\Data\Refund;
use DodoPayments\WebhookEvents\WebhookPayload\Data\Subscription;

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
