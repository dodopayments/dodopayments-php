<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\Invoice\ReminderSettings\Override;
use Dodopayments\Invoices\Invoice\ReminderSettings\Snapshot;

/**
 * `null` on a draft that keeps all reminder settings of the business.
 *
 * @phpstan-import-type SnapshotShape from \Dodopayments\Invoices\Invoice\ReminderSettings\Snapshot
 * @phpstan-import-type OverrideShape from \Dodopayments\Invoices\Invoice\ReminderSettings\Override
 *
 * @phpstan-type ReminderSettingsVariants = Snapshot|Override
 * @phpstan-type ReminderSettingsShape = ReminderSettingsVariants|SnapshotShape|OverrideShape
 */
final class ReminderSettings implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'kind';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['snapshot' => Snapshot::class, 'override' => Override::class];
    }
}
