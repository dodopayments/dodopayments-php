<?php

declare(strict_types=1);

namespace Dodopayments\Services\Entitlements;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Grants\EntitlementGrant;
use Dodopayments\Entitlements\Grants\GrantListParams\Status;
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
     * @return DefaultPageNumberPagination<EntitlementGrant>
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
     * For entitlements whose license-key config uses `manual` fulfillment, grants
     * are created in the `pending` state without a key. Call this endpoint to
     * deliver the key: the grant moves to `delivered`, the customer is emailed the
     * key, and the `license_key.created` and `entitlement_grant.delivered` webhook
     * events are sent.
     *
     * @param string $grantID Grant ID
     * @param string $key the license key value to deliver to the customer
     * @param int|null $activationsLimit Per-key activation limit. Defaults to the entitlement's license-key configuration.
     * @param \DateTimeInterface|null $expiresAt When the key expires. Defaults to the duration in the entitlement's license-key configuration.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function fulfillLicenseKey(
        string $grantID,
        string $key,
        ?int $activationsLimit = null,
        ?\DateTimeInterface $expiresAt = null,
        RequestOptions|array|null $requestOptions = null,
    ): EntitlementGrant {
        $params = Util::removeNulls(
            [
                'key' => $key,
                'activationsLimit' => $activationsLimit,
                'expiresAt' => $expiresAt,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->fulfillLicenseKey($grantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Revoke a single grant. Idempotent: re-revoking an already-revoked
     * grant returns the grant in its current state.
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
    ): EntitlementGrant {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->revoke($grantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
