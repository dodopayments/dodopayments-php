<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementUpdateParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\TelegramConfig;

/**
 * Platform-specific configuration for an entitlement.
 * Each variant uses unique field names so `#[serde(untagged)]` can disambiguate correctly.
 *
 * @phpstan-import-type GitHubConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\GitHubConfig
 * @phpstan-import-type DiscordConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DiscordConfig
 * @phpstan-import-type TelegramConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\TelegramConfig
 * @phpstan-import-type FigmaConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FigmaConfig
 * @phpstan-import-type FramerConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FramerConfig
 * @phpstan-import-type NotionConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\NotionConfig
 * @phpstan-import-type DigitalFilesConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DigitalFilesConfig
 * @phpstan-import-type LicenseKeyConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\LicenseKeyConfig
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
