<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\Entitlement;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\DiscordConfig;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\FigmaConfig;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\FramerConfig;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\GitHubConfig;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\NotionConfig;
use Dodopayments\Products\Product\Entitlement\IntegrationConfig\TelegramConfig;

/**
 * Public-facing variant of [`IntegrationConfig`].  Mirrors every variant
 * shape on the wire EXCEPT `DigitalFiles`, which is replaced with a
 * hydrated `digital_files` object (resolved download URLs etc.).  The
 * persisted JSONB stays ID-only via [`IntegrationConfig`]; this enum is
 * response-only.
 *
 * @phpstan-import-type GitHubConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\GitHubConfig
 * @phpstan-import-type DiscordConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\DiscordConfig
 * @phpstan-import-type TelegramConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\TelegramConfig
 * @phpstan-import-type FigmaConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\FigmaConfig
 * @phpstan-import-type FramerConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\FramerConfig
 * @phpstan-import-type NotionConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\NotionConfig
 * @phpstan-import-type DigitalFilesConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\DigitalFilesConfig
 * @phpstan-import-type LicenseKeyConfigShape from \Dodopayments\Products\Product\Entitlement\IntegrationConfig\LicenseKeyConfig
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
