<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\EntitlementIntegrationType;
use Dodopayments\Entitlements\IntegrationConfigResponse\DigitalFilesConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\DiscordConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\FigmaConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\FramerConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\GitHubConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\LicenseKeyConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\NotionConfig;
use Dodopayments\Entitlements\IntegrationConfigResponse\TelegramConfig;

/**
 * Summary of an entitlement attached to a product.
 *
 * `integration_config` uses [`IntegrationConfigResponse`] (NOT the
 * persisted [`IntegrationConfig`]) so digital_files entitlements embed the
 * resolved `digital_files` object — matching what `GET /entitlements/{id}`
 * returns. All other variants pass through unchanged via
 * `#[serde(untagged)]`.
 *
 * @phpstan-import-type IntegrationConfigResponseVariants from \Dodopayments\Entitlements\IntegrationConfigResponse
 * @phpstan-import-type IntegrationConfigResponseShape from \Dodopayments\Entitlements\IntegrationConfigResponse
 *
 * @phpstan-type ProductEntitlementSummaryShape = array{
 *   id: string,
 *   integrationConfig: IntegrationConfigResponseShape,
 *   integrationType: EntitlementIntegrationType|value-of<EntitlementIntegrationType>,
 *   name: string,
 *   description?: string|null,
 * }
 */
final class ProductEntitlementSummary implements BaseModel
{
    /** @use SdkModel<ProductEntitlementSummaryShape> */
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
     * @var IntegrationConfigResponseVariants $integrationConfig
     */
    #[Required('integration_config')]
    public GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig;

    /** @var value-of<EntitlementIntegrationType> $integrationType */
    #[Required('integration_type', enum: EntitlementIntegrationType::class)]
    public string $integrationType;

    #[Required]
    public string $name;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new ProductEntitlementSummary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductEntitlementSummary::with(
     *   id: ..., integrationConfig: ..., integrationType: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductEntitlementSummary)
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
     * @param IntegrationConfigResponseShape $integrationConfig
     * @param EntitlementIntegrationType|value-of<EntitlementIntegrationType> $integrationType
     */
    public static function with(
        string $id,
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        EntitlementIntegrationType|string $integrationType,
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
     * @param EntitlementIntegrationType|value-of<EntitlementIntegrationType> $integrationType
     */
    public function withIntegrationType(
        EntitlementIntegrationType|string $integrationType
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
