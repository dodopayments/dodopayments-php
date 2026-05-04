<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Entitlements\IntegrationConfigResponse\DigitalFilesConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\DiscordConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\FigmaConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\FramerConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\GitHubConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\LicenseKeyConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\NotionConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\TelegramConfig;

/**
 * Integration-specific configuration on an entitlement read response.
 *
 * For `digital_files` entitlements the response includes presigned
 * download URLs for each attached file; other integrations match the
 * shape supplied at creation.
 *
 * @phpstan-import-type GitHubConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\GitHubConfig
 * @phpstan-import-type DiscordConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\DiscordConfig
 * @phpstan-import-type TelegramConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\TelegramConfig
 * @phpstan-import-type FigmaConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\FigmaConfig
 * @phpstan-import-type FramerConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\FramerConfig
 * @phpstan-import-type NotionConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\NotionConfig
 * @phpstan-import-type DigitalFilesConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\DigitalFilesConfig
 * @phpstan-import-type LicenseKeyConfigShape from \Dodopayments\Entitlements\IntegrationConfigResponse\LicenseKeyConfig
 *
 * @phpstan-type IntegrationConfigResponseVariants = GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig
 * @phpstan-type IntegrationConfigResponseShape = IntegrationConfigResponseVariants|GitHubConfigShape|DiscordConfigShape|TelegramConfigShape|FigmaConfigShape|FramerConfigShape|NotionConfigShape|DigitalFilesConfigShape|LicenseKeyConfigShape
 */
final class IntegrationConfigResponse implements ConverterSource
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
