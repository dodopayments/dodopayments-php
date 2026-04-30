<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Entitlements;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Grants\EntitlementGrant;
use Dodopayments\Entitlements\Grants\GrantListParams\Status;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface GrantsContract
{
    /**
     * @api
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
    ): DefaultPageNumberPagination;

    /**
     * @api
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
    ): EntitlementGrant;
}
