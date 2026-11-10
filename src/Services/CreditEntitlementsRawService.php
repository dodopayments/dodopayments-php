<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\CbbOverageBehavior;
use Dodopayments\CreditEntitlements\CreditEntitlement;
use Dodopayments\CreditEntitlements\CreditEntitlementCreateParams;
use Dodopayments\CreditEntitlements\CreditEntitlementListParams;
use Dodopayments\CreditEntitlements\CreditEntitlementUpdateParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CreditEntitlementsRawContract;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class CreditEntitlementsRawService implements CreditEntitlementsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Credit entitlements define reusable credit templates that can be attached to products.
     * Each entitlement defines how credits behave in terms of expiration, rollover, and overage.
     *
     * # Authentication
     * Requires an API key with `Editor` role.
     *
     * # Request Body
     * - `name` - Human-readable name of the credit entitlement (1-255 characters, required)
     * - `description` - Optional description (max 1000 characters)
     * - `precision` - Decimal precision for credit amounts (0-10 decimal places)
     * - `unit` - Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits")
     * - `expires_after_days` - Number of days after which credits expire (optional)
     * - `rollover_enabled` - Whether unused credits can rollover to the next period
     * - `rollover_percentage` - Percentage of unused credits that rollover (0-100)
     * - `rollover_timeframe_count` - Count of timeframe periods for rollover limit
     * - `rollover_timeframe_interval` - Interval type (day, week, month, year)
     * - `max_rollover_count` - Maximum number of times credits can be rolled over
     * - `overage_enabled` - Whether overage charges apply when credits run out (requires price_per_unit)
     * - `overage_limit` - Maximum overage units allowed (optional)
     * - `currency` - Currency for pricing (required if price_per_unit is set)
     * - `price_per_unit` - Price per credit unit (decimal)
     *
     * # Responses
     * - `201 Created` - Credit entitlement created successfully, returns the full entitlement object
     * - `422 Unprocessable Entity` - Invalid request parameters or validation failure
     * - `500 Internal Server Error` - Database or server error
     *
     * # Business Logic
     * - A unique ID with prefix `cde_` is automatically generated for the entitlement
     * - Created and updated timestamps are automatically set
     * - Currency is required when price_per_unit is set
     * - price_per_unit is required when overage_enabled is true
     * - rollover_timeframe_count and rollover_timeframe_interval must both be set or both be null
     *
     * @param array{
     *   name: string,
     *   overageEnabled: bool,
     *   precision: int,
     *   rolloverEnabled: bool,
     *   unit: string,
     *   currency?: value-of<Currency>,
     *   description?: string|null,
     *   expiresAfterDays?: int|null,
     *   maxRolloverCount?: int|null,
     *   overageBehavior?: value-of<CbbOverageBehavior>,
     *   overageLimit?: int|null,
     *   pricePerUnit?: string|null,
     *   rolloverPercentage?: int|null,
     *   rolloverTimeframeCount?: int|null,
     *   rolloverTimeframeInterval?: TimeInterval|value-of<TimeInterval>|null,
     * }|CreditEntitlementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreditEntitlement>
     *
     * @throws APIException
     */
    public function create(
        array|CreditEntitlementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CreditEntitlementCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'credit-entitlements',
            body: (object) $parsed,
            options: $options,
            convert: CreditEntitlement::class,
        );
    }

    /**
     * @api
     *
     * Returns the full details of a single credit entitlement including all configuration
     * settings for expiration, rollover, and overage policies.
     *
     * # Authentication
     * Requires an API key with `Viewer` role or higher.
     *
     * # Path Parameters
     * - `id` - The unique identifier of the credit entitlement (format: `cde_...`)
     *
     * # Responses
     * - `200 OK` - Returns the full credit entitlement object
     * - `404 Not Found` - Credit entitlement does not exist or does not belong to the authenticated business
     * - `500 Internal Server Error` - Database or server error
     *
     * # Business Logic
     * - Only non-deleted credit entitlements can be retrieved through this endpoint
     * - The entitlement must belong to the authenticated business (business_id check)
     * - Deleted entitlements return a 404 error and must be retrieved via the list endpoint with `deleted=true`
     *
     * @param string $id Credit Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreditEntitlement>
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
            path: ['credit-entitlements/%1$s', $id],
            options: $requestOptions,
            convert: CreditEntitlement::class,
        );
    }

    /**
     * @api
     *
     * Allows partial updates to a credit entitlement's configuration. Only the fields
     * provided in the request body will be updated; all other fields remain unchanged.
     * This endpoint supports nullable fields using the double option pattern.
     *
     * # Authentication
     * Requires an API key with `Editor` role.
     *
     * # Path Parameters
     * - `id` - The unique identifier of the credit entitlement to update (format: `cde_...`)
     *
     * # Request Body (all fields optional)
     * - `name` - Human-readable name of the credit entitlement (1-255 characters)
     * - `description` - Optional description (max 1000 characters)
     * - `unit` - Unit of measurement for the credit (1-50 characters)
     *
     * Note: `precision` cannot be modified after creation as it would invalidate existing grants.
     * - `expires_after_days` - Number of days after which credits expire (use `null` to remove expiration)
     * - `rollover_enabled` - Whether unused credits can rollover to the next period
     * - `rollover_percentage` - Percentage of unused credits that rollover (0-100, nullable)
     * - `rollover_timeframe_count` - Count of timeframe periods for rollover limit (nullable)
     * - `rollover_timeframe_interval` - Interval type (day, week, month, year, nullable)
     * - `max_rollover_count` - Maximum number of times credits can be rolled over (nullable)
     * - `overage_enabled` - Whether overage charges apply when credits run out
     * - `overage_limit` - Maximum overage units allowed (nullable)
     * - `currency` - Currency for pricing (nullable)
     * - `price_per_unit` - Price per credit unit (decimal, nullable)
     *
     * # Responses
     * - `200 OK` - Credit entitlement updated successfully
     * - `404 Not Found` - Credit entitlement does not exist or does not belong to the authenticated business
     * - `422 Unprocessable Entity` - Invalid request parameters or validation failure
     * - `500 Internal Server Error` - Database or server error
     *
     * # Business Logic
     * - Only non-deleted credit entitlements can be updated
     * - Fields set to `null` explicitly will clear the database value (using double option pattern)
     * - The `updated_at` timestamp is automatically updated on successful modification
     * - Changes take effect immediately but do not retroactively affect existing credit grants
     * - The merged state is validated: currency required with price, rollover timeframe fields together, price required for overage
     *
     * @param string $id Credit Entitlement ID
     * @param array{
     *   currency?: value-of<Currency>,
     *   description?: string|null,
     *   expiresAfterDays?: int|null,
     *   maxRolloverCount?: int|null,
     *   name?: string|null,
     *   overageBehavior?: value-of<CbbOverageBehavior>,
     *   overageEnabled?: bool|null,
     *   overageLimit?: int|null,
     *   pricePerUnit?: string|null,
     *   rolloverEnabled?: bool|null,
     *   rolloverPercentage?: int|null,
     *   rolloverTimeframeCount?: int|null,
     *   rolloverTimeframeInterval?: TimeInterval|value-of<TimeInterval>|null,
     *   unit?: string|null,
     * }|CreditEntitlementUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|CreditEntitlementUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CreditEntitlementUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['credit-entitlements/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns a paginated list of credit entitlements, allowing filtering of deleted
     * entitlements. By default, only non-deleted entitlements are returned.
     *
     * # Authentication
     * Requires an API key with `Viewer` role or higher.
     *
     * # Query Parameters
     * - `page_size` - Number of items per page (default: 10, max: 100)
     * - `page_number` - Zero-based page number (default: 0)
     * - `deleted` - Boolean flag to list deleted entitlements instead of active ones (default: false)
     *
     * # Responses
     * - `200 OK` - Returns a list of credit entitlements wrapped in a response object
     * - `422 Unprocessable Entity` - Invalid query parameters (e.g., page_size > 100)
     * - `500 Internal Server Error` - Database or server error
     *
     * # Business Logic
     * - Results are ordered by creation date in descending order (newest first)
     * - Only entitlements belonging to the authenticated business are returned
     * - The `deleted` parameter controls visibility of soft-deleted entitlements
     * - Pagination uses offset-based pagination (offset = page_number * page_size)
     *
     * @param array{
     *   deleted?: bool, pageNumber?: int, pageSize?: int
     * }|CreditEntitlementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<CreditEntitlement>>
     *
     * @throws APIException
     */
    public function list(
        array|CreditEntitlementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CreditEntitlementListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'credit-entitlements',
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: CreditEntitlement::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Credit Entitlement ID
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
            path: ['credit-entitlements/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Undeletes a soft-deleted credit entitlement by clearing `deleted_at`,
     * making it available again through standard list and get endpoints.
     *
     * # Authentication
     * Requires an API key with `Editor` role.
     *
     * # Path Parameters
     * - `id` - The unique identifier of the credit entitlement to restore (format: `cde_...`)
     *
     * # Responses
     * - `200 OK` - Credit entitlement restored successfully
     * - `500 Internal Server Error` - Database error, entitlement not found, or entitlement is not deleted
     *
     * # Business Logic
     * - Only deleted credit entitlements can be restored
     * - The query filters for `deleted_at IS NOT NULL`, so non-deleted entitlements will result in 0 rows affected
     * - If no rows are affected (entitlement doesn't exist, doesn't belong to business, or is not deleted), returns 500
     * - The `updated_at` timestamp is automatically updated on successful restoration
     * - Once restored, the entitlement becomes immediately available in the standard list and get endpoints
     * - All configuration settings are preserved during delete/restore operations
     *
     * # Error Handling
     * This endpoint returns 500 Internal Server Error in several cases:
     * - The credit entitlement does not exist
     * - The credit entitlement belongs to a different business
     * - The credit entitlement is not currently deleted (already active)
     *
     * Callers should verify the entitlement exists and is deleted before calling this endpoint.
     *
     * @param string $id Credit Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function undelete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['credit-entitlements/%1$s/undelete', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
