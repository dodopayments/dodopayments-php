<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig\TelegramConfig;
use Dodopayments\Entitlements\EntitlementGetResponse\IntegrationType;

/**
 * @phpstan-import-type IntegrationConfigVariants from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementGetResponse\IntegrationConfig
 *
 * @phpstan-type EntitlementGetResponseShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   integrationConfig: IntegrationConfigShape,
 *   integrationType: IntegrationType|value-of<IntegrationType>,
 *   isActive: bool,
 *   name: string,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   metadata?: mixed,
 * }
 */
final class EntitlementGetResponse implements BaseModel
{
    /** @use SdkModel<EntitlementGetResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Public-facing variant of [`IntegrationConfig`].  Mirrors every variant
     * shape on the wire EXCEPT `DigitalFiles`, which is replaced with a
     * hydrated `digital_files` object (resolved download URLs etc.).  The
     * persisted JSONB stays ID-only via [`IntegrationConfig`]; this enum is
     * response-only.
     *
     * @var IntegrationConfigVariants $integrationConfig
     */
    #[Required('integration_config')]
    public GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig;

    /** @var value-of<IntegrationType> $integrationType */
    #[Required('integration_type', enum: IntegrationType::class)]
    public string $integrationType;

    #[Required('is_active')]
    public bool $isActive;

    #[Required]
    public string $name;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional]
    public mixed $metadata;

    /**
     * `new EntitlementGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntitlementGetResponse::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   integrationConfig: ...,
     *   integrationType: ...,
     *   isActive: ...,
     *   name: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntitlementGetResponse)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withIntegrationConfig(...)
     *   ->withIntegrationType(...)
     *   ->withIsActive(...)
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
     * @param IntegrationConfigShape $integrationConfig
     * @param IntegrationType|value-of<IntegrationType> $integrationType
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        IntegrationType|string $integrationType,
        bool $isActive,
        string $name,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        mixed $metadata = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['integrationConfig'] = $integrationConfig;
        $self['integrationType'] = $integrationType;
        $self['isActive'] = $isActive;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;
        null !== $metadata && $self['metadata'] = $metadata;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Public-facing variant of [`IntegrationConfig`].  Mirrors every variant
     * shape on the wire EXCEPT `DigitalFiles`, which is replaced with a
     * hydrated `digital_files` object (resolved download URLs etc.).  The
     * persisted JSONB stays ID-only via [`IntegrationConfig`]; this enum is
     * response-only.
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
     * @param IntegrationType|value-of<IntegrationType> $integrationType
     */
    public function withIntegrationType(
        IntegrationType|string $integrationType
    ): self {
        $self = clone $this;
        $self['integrationType'] = $integrationType;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }
}
