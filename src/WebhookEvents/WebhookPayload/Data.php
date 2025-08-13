<?php

declare(strict_types=1);

namespace DodopaymentsClient\WebhookEvents\WebhookPayload;

use DodopaymentsClient\Core\Concerns\Union;
use DodopaymentsClient\Core\Conversion\Contracts\Converter;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;
use DodopaymentsClient\WebhookEvents\WebhookPayload\Data\Dispute;
use DodopaymentsClient\WebhookEvents\WebhookPayload\Data\LicenseKey;
use DodopaymentsClient\WebhookEvents\WebhookPayload\Data\Payment;
use DodopaymentsClient\WebhookEvents\WebhookPayload\Data\Refund;
use DodopaymentsClient\WebhookEvents\WebhookPayload\Data\Subscription;

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
