<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CreditEntitlements\CbbOverageBehavior;
use Dodopayments\CreditEntitlements\CreditEntitlement;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface CreditEntitlementsContract
{
    /**
     * @api
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
    ): CreditEntitlement;

    /**
     * @api
     *
     * @param string $id Credit Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CreditEntitlement;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): DefaultPageNumberPagination;

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
    ): mixed;

    /**
     * @api
     *
     * @param string $id Credit Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function undelete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
