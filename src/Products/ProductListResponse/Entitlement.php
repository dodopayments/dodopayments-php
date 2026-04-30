<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductListResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DiscordConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\FigmaConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\FramerConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\GitHubConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\NotionConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\TelegramConfig;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationType;

/**
 * Summary of an entitlement attached to a product.
 *
 * `integration_config` uses [`IntegrationConfigResponse`] (NOT the
 * persisted [`IntegrationConfig`]) so digital_files entitlements embed the
 * resolved `digital_files` object — matching what `GET /entitlements/{id}`
 * returns. All other variants pass through unchanged via
 * `#[serde(untagged)]`.
 *
 * @phpstan-import-type IntegrationConfigVariants from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig
 *
 * @phpstan-type EntitlementShape = array{
 *   id: string,
 *   integrationConfig: IntegrationConfigShape,
 *   integrationType: IntegrationType|value-of<IntegrationType>,
 *   name: string,
 *   description?: string|null,
 * }
 */
final class Entitlement implements BaseModel
{
    /** @use SdkModel<EntitlementShape> */
    use SdkModel;

    #[Required]
    public string $id;

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

    #[Required]
    public string $name;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new Entitlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entitlement::with(
     *   id: ..., integrationConfig: ..., integrationType: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entitlement)
     *   ->withID(...)
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
     * @param IntegrationType|value-of<IntegrationType> $integrationType
     */
    public static function with(
        string $id,
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        IntegrationType|string $integrationType,
        string $name,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['integrationConfig'] = $integrationConfig;
        $self['integrationType'] = $integrationType;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
