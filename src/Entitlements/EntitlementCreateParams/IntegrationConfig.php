<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementCreateParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\TelegramConfig;

/**
 * Platform-specific configuration (validated per integration_type).
 *
 * @phpstan-import-type GitHubConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\GitHubConfig
 * @phpstan-import-type DiscordConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\DiscordConfig
 * @phpstan-import-type TelegramConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\TelegramConfig
 * @phpstan-import-type FigmaConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\FigmaConfig
 * @phpstan-import-type FramerConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\FramerConfig
 * @phpstan-import-type NotionConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\NotionConfig
 * @phpstan-import-type DigitalFilesConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\DigitalFilesConfig
 * @phpstan-import-type LicenseKeyConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\LicenseKeyConfig
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
