<?php

declare(strict_types=1);

namespace Dodopayments\Services\Entitlements;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Grants\GrantListParams\Status;
use Dodopayments\Entitlements\Grants\GrantListResponse;
use Dodopayments\Entitlements\Grants\GrantRevokeResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Entitlements\GrantsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class GrantsService implements GrantsContract
{
    /**
     * @api
     */
    public GrantsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new GrantsRawService($client);
    }

    /**
     * @api
     *
     * GET /entitlements/{id}/grants (public API)
     *
     * @param string $id Entitlement ID
     * @param string $customerID Filter by customer ID
     * @param int $pageNumber Page number (default 0)
     * @param int $pageSize Page size (default 10, max 100)
     * @param Status|value-of<Status> $status Filter by grant status
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<GrantListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function revoke(
        string $grantID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): GrantRevokeResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->revoke($grantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
