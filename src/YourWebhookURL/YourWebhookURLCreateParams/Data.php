<?php

declare(strict_types=1);

namespace Dodopayments\YourWebhookURL\YourWebhookURLCreateParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditBalanceLow;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditLedgerEntry;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

/**
 * The latest data at the time of delivery attempt.
 *
 * @phpstan-import-type PaymentShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment
 * @phpstan-import-type SubscriptionShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription
 * @phpstan-import-type RefundShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund
 * @phpstan-import-type DisputeShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute
 * @phpstan-import-type LicenseKeyShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey
 * @phpstan-import-type CreditLedgerEntryShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditLedgerEntry
 * @phpstan-import-type CreditBalanceLowShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditBalanceLow
 *
 * @phpstan-type DataVariants = Payment|Subscription|Refund|Dispute|LicenseKey|CreditLedgerEntry|CreditBalanceLow
 * @phpstan-type DataShape = DataVariants|PaymentShape|SubscriptionShape|RefundShape|DisputeShape|LicenseKeyShape|CreditLedgerEntryShape|CreditBalanceLowShape
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
            CreditLedgerEntry::class,
            CreditBalanceLow::class,
        ];
    }
}
