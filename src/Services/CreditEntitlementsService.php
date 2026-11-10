<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\CbbOverageBehavior;
use Dodopayments\CreditEntitlements\CreditEntitlement;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CreditEntitlementsContract;
use Dodopayments\Services\CreditEntitlements\BalancesService;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class CreditEntitlementsService implements CreditEntitlementsContract
{
    /**
     * @api
     */
    public CreditEntitlementsRawService $raw;

    /**
     * @api
     */
    public BalancesService $balances;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CreditEntitlementsRawService($client);
        $this->balances = new BalancesService($client);
    }

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
     * @param string $name Name of the credit entitlement
     * @param bool $overageEnabled Whether overage charges are enabled when credits run out
     * @param int $precision Precision for credit amounts (0-10 decimal places)
     * @param bool $rolloverEnabled Whether rollover is enabled for unused credits
     * @param string $unit Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits")
     * @param Currency|value-of<Currency>|null $currency Currency for pricing (required if price_per_unit is set)
     * @param string|null $description Optional description of the credit entitlement
     * @param int|null $expiresAfterDays Number of days after which credits expire (optional)
     * @param int|null $maxRolloverCount Maximum number of times credits can be rolled over
     * @param CbbOverageBehavior|value-of<CbbOverageBehavior>|null $overageBehavior Controls how overage is handled at billing cycle end.
     * Defaults to forgive_at_reset if not specified.
     * @param int|null $overageLimit Maximum overage units allowed (optional)
     * @param string|null $pricePerUnit Price per credit unit
     * @param int|null $rolloverPercentage Percentage of unused credits that can rollover (0-100)
     * @param int|null $rolloverTimeframeCount Count of timeframe periods for rollover limit
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval Interval type for rollover timeframe
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        bool $overageEnabled,
        int $precision,
        bool $rolloverEnabled,
        string $unit,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?int $expiresAfterDays = null,
        ?int $maxRolloverCount = null,
        CbbOverageBehavior|string|null $overageBehavior = null,
        ?int $overageLimit = null,
        ?string $pricePerUnit = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
        RequestOptions|array|null $requestOptions = null,
    ): CreditEntitlement {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'overageEnabled' => $overageEnabled,
                'precision' => $precision,
                'rolloverEnabled' => $rolloverEnabled,
                'unit' => $unit,
                'currency' => $currency,
                'description' => $description,
                'expiresAfterDays' => $expiresAfterDays,
                'maxRolloverCount' => $maxRolloverCount,
                'overageBehavior' => $overageBehavior,
                'overageLimit' => $overageLimit,
                'pricePerUnit' => $pricePerUnit,
                'rolloverPercentage' => $rolloverPercentage,
                'rolloverTimeframeCount' => $rolloverTimeframeCount,
                'rolloverTimeframeInterval' => $rolloverTimeframeInterval,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CreditEntitlement {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param Currency|value-of<Currency>|null $currency Currency for pricing
     * @param string|null $description Optional description of the credit entitlement
     * @param int|null $expiresAfterDays Number of days after which credits expire
     * @param int|null $maxRolloverCount Maximum number of times credits can be rolled over
     * @param string|null $name Name of the credit entitlement
     * @param CbbOverageBehavior|value-of<CbbOverageBehavior>|null $overageBehavior controls how overage is handled at billing cycle end
     * @param bool|null $overageEnabled Whether overage charges are enabled when credits run out
     * @param int|null $overageLimit Maximum overage units allowed
     * @param string|null $pricePerUnit Price per credit unit
     * @param bool|null $rolloverEnabled Whether rollover is enabled for unused credits
     * @param int|null $rolloverPercentage Percentage of unused credits that can rollover (0-100)
     * @param int|null $rolloverTimeframeCount Count of timeframe periods for rollover limit
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval Interval type for rollover timeframe
     * @param string|null $unit Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits")
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?int $expiresAfterDays = null,
        ?int $maxRolloverCount = null,
        ?string $name = null,
        CbbOverageBehavior|string|null $overageBehavior = null,
        ?bool $overageEnabled = null,
        ?int $overageLimit = null,
        ?string $pricePerUnit = null,
        ?bool $rolloverEnabled = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
        ?string $unit = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'currency' => $currency,
                'description' => $description,
                'expiresAfterDays' => $expiresAfterDays,
                'maxRolloverCount' => $maxRolloverCount,
                'name' => $name,
                'overageBehavior' => $overageBehavior,
                'overageEnabled' => $overageEnabled,
                'overageLimit' => $overageLimit,
                'pricePerUnit' => $pricePerUnit,
                'rolloverEnabled' => $rolloverEnabled,
                'rolloverPercentage' => $rolloverPercentage,
                'rolloverTimeframeCount' => $rolloverTimeframeCount,
                'rolloverTimeframeInterval' => $rolloverTimeframeInterval,
                'unit' => $unit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param bool $deleted List deleted credit entitlements
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<CreditEntitlement>
     *
     * @throws APIException
     */
    public function list(
        ?bool $deleted = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'deleted' => $deleted,
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
     * @param string $id Credit Entitlement ID
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
     * @throws APIException
     */
    public function undelete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->undelete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
