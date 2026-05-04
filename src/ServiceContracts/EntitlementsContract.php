<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Entitlement;
use Dodopayments\Entitlements\EntitlementIntegrationType;
use Dodopayments\Entitlements\EntitlementListParams\IntegrationType;
use Dodopayments\Entitlements\IntegrationConfig\DigitalFilesConfig;
use Dodopayments\Entitlements\IntegrationConfig\DiscordConfig;
use Dodopayments\Entitlements\IntegrationConfig\FigmaConfig;
use Dodopayments\Entitlements\IntegrationConfig\FramerConfig;
use Dodopayments\Entitlements\IntegrationConfig\GitHubConfig;
use Dodopayments\Entitlements\IntegrationConfig\LicenseKeyConfig;
use Dodopayments\Entitlements\IntegrationConfig\NotionConfig;
use Dodopayments\Entitlements\IntegrationConfig\TelegramConfig;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\IntegrationConfig
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface EntitlementsContract
{
    /**
     * @api
     *
     * @param IntegrationConfigShape $integrationConfig Platform-specific configuration (validated per integration_type)
     * @param EntitlementIntegrationType|value-of<EntitlementIntegrationType> $integrationType Which platform integration this entitlement uses
     * @param string $name Display name for this entitlement
     * @param string|null $description Optional description
     * @param array<string,string> $metadata Additional metadata for the entitlement
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig $integrationConfig,
        EntitlementIntegrationType|string $integrationType,
        string $name,
        ?string $description = null,
        ?array $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entitlement;

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
    ): Entitlement;

    /**
     * @api
     *
     * @param string $id Entitlement ID
     * @param IntegrationConfigShape|null $integrationConfig Integration-specific configuration supplied when creating or updating
     * an entitlement. The shape required matches the entitlement's
     * `integration_type`.
     * @param array<string,string>|null $metadata
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        GitHubConfig|array|DiscordConfig|TelegramConfig|FigmaConfig|FramerConfig|NotionConfig|DigitalFilesConfig|LicenseKeyConfig|null $integrationConfig = null,
        ?array $metadata = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entitlement;

    /**
     * @api
     *
     * @param IntegrationType|value-of<IntegrationType> $integrationType Filter by integration type
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
