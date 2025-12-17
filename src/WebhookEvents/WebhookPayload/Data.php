<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload;

use Dodopayments\Core\Concerns\SdkUnion;
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
 * @phpstan-import-type PaymentShape from \Dodopayments\WebhookEvents\WebhookPayload\Data\Payment
 * @phpstan-import-type SubscriptionShape from \Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription
 * @phpstan-import-type RefundShape from \Dodopayments\WebhookEvents\WebhookPayload\Data\Refund
 * @phpstan-import-type DisputeShape from \Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute
 * @phpstan-import-type LicenseKeyShape from \Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey
 *
 * @phpstan-type DataShape = PaymentShape|SubscriptionShape|RefundShape|DisputeShape|LicenseKeyShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
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
