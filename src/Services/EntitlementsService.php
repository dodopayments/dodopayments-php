<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Entitlement;
use Dodopayments\Entitlements\EntitlementIntegrationType;
use Dodopayments\Entitlements\EntitlementListParams\IntegrationType;
use Dodopayments\Entitlements\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\IntegrationConfig\FeatureFlagConfig;
use Dodopayments\Entitlements\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\IntegrationConfig\TelegramConfig;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\EntitlementsContract;
use Dodopayments\Services\Entitlements\FilesService;
use Dodopayments\Services\Entitlements\GrantsService;
use Dodopayments\Services\Entitlements\TranslationsService;

/**
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\IntegrationConfig
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class EntitlementsService implements EntitlementsContract
{
    /**
     * @api
     */
    public EntitlementsRawService $raw;

    /**
     * @api
     */
    public TranslationsService $translations;

    /**
     * @api
     */
    public FilesService $files;

    /**
     * @api
     */
    public GrantsService $grants;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EntitlementsRawService($client);
        $this->translations = new TranslationsService($client);
        $this->files = new FilesService($client);
        $this->grants = new GrantsService($client);
    }

    /**
     * @api
     *
     * POST /entitlements
     *
     * @param IntegrationConfigShape $integrationConfig Platform-specific configuration (validated per integration_type)
     * @param EntitlementIntegrationType|value-of<EntitlementIntegrationType> $integrationType Which platform integration this entitlement uses
     * @param string $name Display name for this entitlement
     * @param string|null $description Optional description
     * @param array<string,MetadataItemShape> $metadata Additional metadata for the entitlement
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        FeatureFlagConfig|array|GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        EntitlementIntegrationType|string $integrationType,
        string $name,
        ?string $description = null,
        ?array $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entitlement {
        $params = Util::removeNulls(
            [
                'integrationConfig' => $integrationConfig,
                'integrationType' => $integrationType,
                'name' => $name,
                'description' => $description,
                'metadata' => $metadata,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * GET /entitlements/{id}
     *
     * @param string $id Entitlement ID
     * @param string $locale Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?string $locale = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entitlement {
        $params = Util::removeNulls(['locale' => $locale]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * PATCH /entitlements/{id}
     *
     * @param string $id Entitlement ID
     * @param IntegrationConfigShape|null $integrationConfig Integration-specific configuration supplied when creating or updating
     * an entitlement. The shape required matches the entitlement's
     * `integration_type`.
     *
     * Untagged enum: variants are matched in order. `FeatureFlag` must precede
     * `LicenseKey`, whose fields are all optional and would otherwise match a
     * `feature_flag` config.
     * @param array<string,MetadataItemShape>|null $metadata Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        FeatureFlagConfig|array|GitHubConfig|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig = null,
        ?array $metadata = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entitlement {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'integrationConfig' => $integrationConfig,
                'metadata' => $metadata,
                'name' => $name,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * GET /entitlements
     *
     * @param IntegrationType|value-of<IntegrationType> $integrationType Filter by integration type
     * @param string $locale Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
     * @param int $pageNumber Page number (default 0)
     * @param int $pageSize Page size (default 10, max 100)
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<Entitlement>
     *
     * @throws APIException
     */
    public function list(
        IntegrationType|string|null $integrationType = null,
        ?string $locale = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'integrationType' => $integrationType,
                'locale' => $locale,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * DELETE /entitlements/{id} (soft-delete)
     *
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
