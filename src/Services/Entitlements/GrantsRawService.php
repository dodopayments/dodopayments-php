<?php

declare(strict_types=1);

namespace Dodopayments\Services\Entitlements;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Grants\EntitlementGrant;
use Dodopayments\Entitlements\Grants\GrantListParams;
use Dodopayments\Entitlements\Grants\GrantListParams\Status;
use Dodopayments\Entitlements\Grants\GrantRevokeParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Entitlements\GrantsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class GrantsRawService implements GrantsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * GET /entitlements/{id}/grants (public API)
     *
     * @param string $id Entitlement ID
     * @param array{
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: Status|value-of<Status>,
     * }|GrantListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<EntitlementGrant>>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|GrantListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GrantListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['entitlements/%1$s/grants', $id],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'customerID' => 'customer_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: EntitlementGrant::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * Revokes a single entitlement grant for the caller's business.
     * For LicenseKey integrations, also disables the backing license key.
     * Idempotent: re-revoking an already-revoked grant returns 200 with current state.
     * The revocation reason is always set to "manual" for API-initiated revocations.
     *
     * @param string $grantID Grant ID
     * @param array{id: string}|GrantRevokeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitlementGrant>
     *
     * @throws APIException
     */
    public function revoke(
        string $grantID,
        array|GrantRevokeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GrantRevokeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['entitlements/%1$s/grants/%2$s', $id, $grantID],
            options: $options,
            convert: EntitlementGrant::class,
        );
    }
}
