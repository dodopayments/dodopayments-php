<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\IntegrationConfigResponse\DigitalFilesConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\DiscordConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\FigmaConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\FramerConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\GitHubConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\LicenseKeyConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\NotionConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\TelegramConfig;

/**
 * Detailed view of a single entitlement: identity, integration type,
 * integration-specific configuration, and metadata.
 *
 * @phpstan-import-type IntegrationConfigResponseVariants from \Dodopayments\Entitlements\IntegrationConfigResponse
 * @phpstan-import-type IntegrationConfigResponseShape from \Dodopayments\Entitlements\IntegrationConfigResponse
 *
 * @phpstan-type EntitlementShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   integrationConfig: IntegrationConfigResponseShape,
 *   integrationType: EntitlementIntegrationType|value-of<EntitlementIntegrationType>,
 *   isActive: bool,
 *   metadata: array<string,string>,
 *   name: string,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 * }
 */
final class Entitlement implements BaseModel
{
    /** @use SdkModel<EntitlementShape> */
    use SdkModel;

    /**
     * Unique identifier of the entitlement.
     */
    #[Required]
    public string $id;

    /**
     * Identifier of the business that owns this entitlement.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Timestamp when the entitlement was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Integration-specific configuration. For `digital_files` entitlements
     * this includes presigned download URLs for each attached file.
     *
     * @var IntegrationConfigResponseVariants $integrationConfig
     */
    #[Required('integration_config')]
    public GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig;

    /**
     * Platform integration this entitlement uses.
     *
     * @var value-of<EntitlementIntegrationType> $integrationType
     */
    #[Required('integration_type', enum: EntitlementIntegrationType::class)]
    public string $integrationType;

    /**
     * Always `true` for entitlements returned by the public API;
     * soft-deleted entitlements are not returned.
     */
    #[Required('is_active')]
    public bool $isActive;

    /**
     * Arbitrary key-value metadata supplied at creation or via PATCH.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Display name supplied at creation.
     */
    #[Required]
    public string $name;

    /**
     * Timestamp when the entitlement was last modified.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Optional description supplied at creation.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new Entitlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entitlement::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   integrationConfig: ...,
     *   integrationType: ...,
     *   isActive: ...,
     *   metadata: ...,
     *   name: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entitlement)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withIntegrationConfig(...)
     *   ->withIntegrationType(...)
     *   ->withIsActive(...)
     *   ->withMetadata(...)
     *   ->withName(...)
     *   ->withUpdatedAt(...)
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
     * @param IntegrationConfigResponseShape $integrationConfig
     * @param EntitlementIntegrationType|value-of<EntitlementIntegrationType> $integrationType
     * @param array<string,string> $metadata
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        EntitlementIntegrationType|string $integrationType,
        bool $isActive,
        array $metadata,
        string $name,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['integrationConfig'] = $integrationConfig;
        $self['integrationType'] = $integrationType;
        $self['isActive'] = $isActive;
        $self['metadata'] = $metadata;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Unique identifier of the entitlement.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Identifier of the business that owns this entitlement.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Timestamp when the entitlement was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Integration-specific configuration. For `digital_files` entitlements
     * this includes presigned download URLs for each attached file.
     *
     * @param IntegrationConfigResponseShape $integrationConfig
     */
    public function withIntegrationConfig(
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
    ): self {
        $self = clone $this;
        $self['integrationConfig'] = $integrationConfig;

        return $self;
    }

    /**
     * Platform integration this entitlement uses.
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
     * Always `true` for entitlements returned by the public API;
     * soft-deleted entitlements are not returned.
     */
    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    /**
     * Arbitrary key-value metadata supplied at creation or via PATCH.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Display name supplied at creation.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Timestamp when the entitlement was last modified.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Optional description supplied at creation.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
