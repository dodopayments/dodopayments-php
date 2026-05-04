<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\IntegrationConfig\TelegramConfig;

/**
 * POST /entitlements.
 *
 * @see Dodopayments\Services\EntitlementsService::create()
 *
 * @phpstan-import-type IntegrationConfigVariants from \Dodopayments\Entitlements\IntegrationConfig
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\IntegrationConfig
 *
 * @phpstan-type EntitlementCreateParamsShape = array{
 *   integrationConfig: IntegrationConfigShape,
 *   integrationType: EntitlementIntegrationType|value-of<EntitlementIntegrationType>,
 *   name: string,
 *   description?: string|null,
 *   metadata?: array<string,string>|null,
 * }
 */
final class EntitlementCreateParams implements BaseModel
{
    /** @use SdkModel<EntitlementCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Platform-specific configuration (validated per integration_type).
     *
     * @var IntegrationConfigVariants $integrationConfig
     */
    #[Required('integration_config')]
    public GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig;

    /**
     * Which platform integration this entitlement uses.
     *
     * @var value-of<EntitlementIntegrationType> $integrationType
     */
    #[Required('integration_type', enum: EntitlementIntegrationType::class)]
    public string $integrationType;

    /**
     * Display name for this entitlement.
     */
    #[Required]
    public string $name;

    /**
     * Optional description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Additional metadata for the entitlement.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * `new EntitlementCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntitlementCreateParams::with(
     *   integrationConfig: ..., integrationType: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntitlementCreateParams)
     *   ->withIntegrationConfig(...)
     *   ->withIntegrationType(...)
     *   ->withName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param IntegrationConfigShape $integrationConfig
     * @param EntitlementIntegrationType|value-of<EntitlementIntegrationType> $integrationType
     * @param array<string,string>|null $metadata
     */
    public static function with(
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        EntitlementIntegrationType|string $integrationType,
        string $name,
        ?string $description = null,
        ?array $metadata = null,
    ): self {
        $self = new self;

        $self['integrationConfig'] = $integrationConfig;
        $self['integrationType'] = $integrationType;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $metadata && $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Platform-specific configuration (validated per integration_type).
     *
     * @param IntegrationConfigShape $integrationConfig
     */
    public function withIntegrationConfig(
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
    ): self {
        $self = clone $this;
        $self['integrationConfig'] = $integrationConfig;

        return $self;
    }

    /**
     * Which platform integration this entitlement uses.
     *
     * @param EntitlementIntegrationType|value-of<EntitlementIntegrationType> $integrationType
     */
    public function withIntegrationType(
        EntitlementIntegrationType|string $integrationType
    ): self {
        $self = clone $this;
        $self['integrationType'] = $integrationType;

        return $self;
    }

    /**
     * Display name for this entitlement.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Additional metadata for the entitlement.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }
}
