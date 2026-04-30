<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementGetResponse;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\TelegramConfig;

/**
 * Public-facing variant of [`IntegrationConfig`].  Mirrors every variant
 * shape on the wire EXCEPT `DigitalFiles`, which is replaced with a
 * hydrated `digital_files` object (resolved download URLs etc.).  The
 * persisted JSONB stays ID-only via [`IntegrationConfig`]; this enum is
 * response-only.
 *
 * @phpstan-import-type GitHubConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\GitHubConfig
 * @phpstan-import-type DiscordConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\DiscordConfig
 * @phpstan-import-type TelegramConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\TelegramConfig
 * @phpstan-import-type FigmaConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\FigmaConfig
 * @phpstan-import-type FramerConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\FramerConfig
 * @phpstan-import-type NotionConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\NotionConfig
 * @phpstan-import-type DigitalFilesConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\DigitalFilesConfig
 * @phpstan-import-type LicenseKeyConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\LicenseKeyConfig
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
