<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\EntitlementCreateParams;
use Dodopayments\Entitlements\EntitlementCreateParams\IntegrationType;
use Dodopayments\Entitlements\EntitlementGetResponse;
use Dodopayments\Entitlements\EntitlementListParams;
use Dodopayments\Entitlements\EntitlementListResponse;
use Dodopayments\Entitlements\EntitlementNewResponse;
use Dodopayments\Entitlements\EntitlementUpdateParams;
use Dodopayments\Entitlements\EntitlementUpdateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\EntitlementsRawContract;

/**
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementCreateParams\IntegrationConfig
 * @phpstan-import-type IntegrationConfigShape from \Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig as IntegrationConfigShape1
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
     *   integrationType: value-of<IntegrationType>,
     *   name: string,
     *   description?: string|null,
     *   metadata?: array<string,string>|null,
     * }|EntitlementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitlementNewResponse>
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
            convert: EntitlementNewResponse::class,
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
     * @return BaseResponse<EntitlementGetResponse>
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
            convert: EntitlementGetResponse::class,
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
     *   integrationConfig?: IntegrationConfigShape1|null,
     *   metadata?: array<string,string>|null,
     *   name?: string|null,
     * }|EntitlementUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitlementUpdateResponse>
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
            convert: EntitlementUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * GET /entitlements
     *
     * @param array{
     *   integrationType?: value-of<EntitlementListParams\IntegrationType>,
     *   pageNumber?: int,
     *   pageSize?: int,
     * }|EntitlementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<EntitlementListResponse>>
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
            convert: EntitlementListResponse::class,
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
