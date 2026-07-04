<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\IntegrationConfig\FeatureFlagConfig;
use Dodopayments\Entitlements\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\IntegrationConfig\TelegramConfig;
use Dodopayments\Misc\MetadataItem;

/**
 * PATCH /entitlements/{id}.
 *
 * @see Dodopayments\Services\EntitlementsService::update()
 *
 * @phpstan-import-type IntegrationConfigVariants from \Dodopayments\Entitlements\IntegrationConfig
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\IntegrationConfig
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 *
 * @phpstan-type EntitlementUpdateParamsShape = array{
 *   description?: string|null,
 *   integrationConfig?: IntegrationConfigShape|null,
 *   metadata?: array<string,MetadataItemShape>|null,
 *   name?: string|null,
 * }
 */
final class EntitlementUpdateParams implements BaseModel
{
    /** @use SdkModel<EntitlementUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Integration-specific configuration supplied when creating or updating
     * an entitlement. The shape required matches the entitlement's
     * `integration_type`.
     *
     * Untagged enum: variants are matched in order. `FeatureFlag` must precede
     * `LicenseKey`, whose fields are all optional and would otherwise match a
     * `feature_flag` config.
     *
     * @var IntegrationConfigVariants|null $integrationConfig
     */
    #[Optional('integration_config', nullable: true)]
    public FeatureFlagConfig|GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string,MetadataItemVariants>|null $metadata
     */
    #[Optional(map: MetadataItem::class, nullable: true)]
    public ?array $metadata;

    #[Optional(nullable: true)]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param IntegrationConfigShape|null $integrationConfig
     * @param array<string,MetadataItemShape>|null $metadata
     */
    public static function with(
        ?string $description = null,
        FeatureFlagConfig|array|GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig = null,
        ?array $metadata = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $integrationConfig && $self['integrationConfig'] = $integrationConfig;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Integration-specific configuration supplied when creating or updating
     * an entitlement. The shape required matches the entitlement's
     * `integration_type`.
     *
     * Untagged enum: variants are matched in order. `FeatureFlag` must precede
     * `LicenseKey`, whose fields are all optional and would otherwise match a
     * `feature_flag` config.
     *
     * @param IntegrationConfigShape|null $integrationConfig
     */
    public function withIntegrationConfig(
        FeatureFlagConfig|array|GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig,
    ): self {
        $self = clone $this;
        $self['integrationConfig'] = $integrationConfig;

        return $self;
    }

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @param array<string,MetadataItemShape>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
