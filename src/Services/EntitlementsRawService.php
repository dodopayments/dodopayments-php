<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Entitlement;
use Dodopayments\Entitlements\EntitlementCreateParams;
use Dodopayments\Entitlements\EntitlementIntegrationType;
use Dodopayments\Entitlements\EntitlementListParams;
use Dodopayments\Entitlements\EntitlementListParams\IntegrationType;
use Dodopayments\Entitlements\EntitlementUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\EntitlementsRawContract;

/**
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\IntegrationConfig
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class EntitlementsRawService implements EntitlementsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * POST /entitlements
     *
     * @param array{
     *   integrationConfig: IntegrationConfigShape,
     *   integrationType: value-of<EntitlementIntegrationType>,
     *   name: string,
     *   description?: string|null,
     *   metadata?: array<string,string>,
     * }|EntitlementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entitlement>
     *
     * @throws APIException
     */
    public function create(
        array|EntitlementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntitlementCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'entitlements',
            body: (object) $parsed,
            options: $options,
            convert: Entitlement::class,
        );
    }

    /**
     * @api
     *
     * GET /entitlements/{id}
     *
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entitlement>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['entitlements/%1$s', $id],
            options: $requestOptions,
            convert: Entitlement::class,
        );
    }

    /**
     * @api
     *
     * PATCH /entitlements/{id}
     *
     * @param string $id Entitlement ID
     * @param array{
     *   description?: string|null,
     *   integrationConfig?: IntegrationConfigShape|null,
     *   metadata?: array<string,string>|null,
     *   name?: string|null,
     * }|EntitlementUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entitlement>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|EntitlementUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntitlementUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['entitlements/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: Entitlement::class,
        );
    }

    /**
     * @api
     *
     * GET /entitlements
     *
     * @param array{
     *   integrationType?: value-of<IntegrationType>, pageNumber?: int, pageSize?: int
     * }|EntitlementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Entitlement>>
     *
     * @throws APIException
     */
    public function list(
        array|EntitlementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntitlementListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'entitlements',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'integrationType' => 'integration_type',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: Entitlement::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * DELETE /entitlements/{id} (soft-delete)
     *
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['entitlements/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
