<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig\TelegramConfig;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationType;
use Dodopayments\Entitlements\EntitlementGetResponse;
use Dodopayments\Entitlements\EntitlementListResponse;
use Dodopayments\Entitlements\EntitlementNewResponse;
use Dodopayments\Entitlements\EntitlementUpdateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\EntitlementsContract;
use Dodopayments\Services\Entitlements\FilesService;
use Dodopayments\Services\Entitlements\GrantsService;

/**
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig as IntegrationConfigShape1
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
        $this->files = new FilesService($client);
        $this->grants = new GrantsService($client);
    }

    /**
     * @api
     *
     * POST /entitlements
     *
     * @param IntegrationConfigShape $integrationConfig Platform-specific configuration (validated per integration_type)
     * @param IntegrationType|value-of<IntegrationType> $integrationType Which platform integration this entitlement uses
     * @param string $name Display name for this entitlement
     * @param string|null $description Optional description
     * @param array<string,string>|null $metadata Optional user-facing metadata
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        IntegrationType|string $integrationType,
        string $name,
        ?string $description = null,
        ?array $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): EntitlementNewResponse {
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): EntitlementGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * PATCH /entitlements/{id}
     *
     * @param string $id Entitlement ID
     * @param IntegrationConfigShape1|null $integrationConfig Platform-specific configuration for an entitlement.
     * Each variant uses unique field names so `#[serde(untagged)]` can disambiguate correctly.
     * @param array<string,string>|null $metadata
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\GitHubConfig|array|\Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DiscordConfig|\Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\TelegramConfig|\Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FigmaConfig|\Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\FramerConfig|\Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\NotionConfig|\Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\DigitalFilesConfig|\Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig\LicenseKeyConfig|null $integrationConfig = null,
        ?array $metadata = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): EntitlementUpdateResponse {
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
     * @param \Dodopayments\Entitlements\EntitlementListParams\IntegrationType|value-of<\Dodopayments\Entitlements\EntitlementListParams\IntegrationType> $integrationType Filter by integration type
     * @param int $pageNumber Page number (default 0)
     * @param int $pageSize Page size (default 10, max 100)
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<EntitlementListResponse>
     *
     * @throws APIException
     */
    public function list(
        \Dodopayments\Entitlements\EntitlementListParams\IntegrationType|string|null $integrationType = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'integrationType' => $integrationType,
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
