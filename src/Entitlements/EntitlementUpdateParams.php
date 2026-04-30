<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\TelegramConfig;

/**
 * PATCH /entitlements/{id}.
 *
 * @see Dodopayments\Services\EntitlementsService::update()
 *
 * @phpstan-import-type IntegrationConfigVariants from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig
 *
 * @phpstan-type EntitlementUpdateParamsShape = array{
 *   description?: string|null,
 *   integrationConfig?: IntegrationConfigShape|null,
 *   metadata?: array<string,string>|null,
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
     * Platform-specific configuration for an entitlement.
     * Each variant uses unique field names so `#[serde(untagged)]` can disambiguate correctly.
     *
     * @var IntegrationConfigVariants|null $integrationConfig
     */
    #[Optional('integration_config', nullable: true)]
    public GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig;

    /** @var array<string,string>|null $metadata */
    #[Optional(map: 'string', nullable: true)]
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
     * @param array<string,string>|null $metadata
     */
    public static function with(
        ?string $description = null,
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig = null,
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
     * Platform-specific configuration for an entitlement.
     * Each variant uses unique field names so `#[serde(untagged)]` can disambiguate correctly.
     *
     * @param IntegrationConfigShape|null $integrationConfig
     */
    public function withIntegrationConfig(
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig,
    ): self {
        $self = clone $this;
        $self['integrationConfig'] = $integrationConfig;

        return $self;
    }

    /**
     * @param array<string,string>|null $metadata
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
