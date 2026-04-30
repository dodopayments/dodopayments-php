<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementListResponse;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\TelegramConfig;

/**
 * Public-facing variant of [`IntegrationConfig`].  Mirrors every variant
 * shape on the wire EXCEPT `DigitalFiles`, which is replaced with a
 * hydrated `digital_files` object (resolved download URLs etc.).  The
 * persisted JSONB stays ID-only via [`IntegrationConfig`]; this enum is
 * response-only.
 *
 * @phpstan-import-type GitHubConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\GitHubConfig
 * @phpstan-import-type DiscordConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\DiscordConfig
 * @phpstan-import-type TelegramConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\TelegramConfig
 * @phpstan-import-type FigmaConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\FigmaConfig
 * @phpstan-import-type FramerConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\FramerConfig
 * @phpstan-import-type NotionConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\NotionConfig
 * @phpstan-import-type DigitalFilesConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\DigitalFilesConfig
 * @phpstan-import-type LicenseKeyConfigShape from \Dodopayments\Entitlements\EntitlementListResponse\IntegrationConfig\LicenseKeyConfig
 *
 * @phpstan-type IntegrationConfigVariants = GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig
 * @phpstan-type IntegrationConfigShape = IntegrationConfigVariants|GitHubConfigShape|DiscordConfigShape|TelegramConfigShape|FigmaConfigShape|FramerConfigShape|NotionConfigShape|DigitalFilesConfigShape|LicenseKeyConfigShape
 */
final class IntegrationConfig implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            GitHubConfig::class,
            DiscordConfig::class,
            TelegramConfig::class,
            FigmaConfig::class,
            FramerConfig::class,
            NotionConfig::class,
            DigitalFilesConfig::class,
            LicenseKeyConfig::class,
        ];
    }
}
