<?php

declare(strict_types=1);

namespace DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams;

use DodopaymentsClient\Core\Concerns\Union;
use DodopaymentsClient\Core\Conversion\Contracts\Converter;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

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
