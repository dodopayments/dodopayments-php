<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductListResponse\Entitlement;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DiscordConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\FigmaConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\FramerConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\GitHubConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\NotionConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\TelegramConfig;

/**
 * Platform-specific configuration for an entitlement.
 * Each variant uses unique field names so `#[serde(untagged)]` can disambiguate correctly.
 *
 * @phpstan-import-type GitHubConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\GitHubConfig
 * @phpstan-import-type DiscordConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DiscordConfig
 * @phpstan-import-type TelegramConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\TelegramConfig
 * @phpstan-import-type FigmaConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\FigmaConfig
 * @phpstan-import-type FramerConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\FramerConfig
 * @phpstan-import-type NotionConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\NotionConfig
 * @phpstan-import-type DigitalFilesConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DigitalFilesConfig
 * @phpstan-import-type LicenseKeyConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\LicenseKeyConfig
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
