<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
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

/**
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig as IntegrationConfigShape1
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface EntitlementsContract
{
    /**
     * @api
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
    ): EntitlementNewResponse;

    /**
     * @api
     *
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): EntitlementGetResponse;

    /**
     * @api
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
    ): EntitlementUpdateResponse;

    /**
     * @api
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
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
