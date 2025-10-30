<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Get detailed usage history for a subscription that includes usage-based billing (metered components).
 * This endpoint provides insights into customer usage patterns and billing calculations over time.
 *
 * ## What You'll Get:
 * - **Billing periods**: Each item represents a billing cycle with start and end dates
 * - **Meter usage**: Detailed breakdown of usage for each meter configured on the subscription
 * - **Usage calculations**: Total units consumed, free threshold units, and chargeable units
 * - **Historical tracking**: Complete audit trail of usage-based charges
 *
 * ## Use Cases:
 * - **Customer support**: Investigate billing questions and usage discrepancies
 * - **Usage analytics**: Analyze customer consumption patterns over time
 * - **Billing transparency**: Provide customers with detailed usage breakdowns
 * - **Revenue optimization**: Identify usage trends to optimize pricing strategies
 *
 * ## Filtering Options:
 * - **Date range filtering**: Get usage history for specific time periods
 * - **Meter-specific filtering**: Focus on usage for a particular meter
 * - **Pagination**: Navigate through large usage histories efficiently
 *
 * ## Important Notes:
 * - Only returns data for subscriptions with usage-based (metered) components
 * - Usage history is organized by billing periods (subscription cycles)
 * - Free threshold units are calculated and displayed separately from chargeable units
 * - Historical data is preserved even if meter configurations change
 *
 * ## Example Query Patterns:
 * - Get last 3 months: `?start_date=2024-01-01T00:00:00Z&end_date=2024-03-31T23:59:59Z`
 * - Filter by meter: `?meter_id=mtr_api_requests`
 * - Paginate results: `?page_size=20&page_number=1`
 * - Recent usage: `?start_date=2024-03-01T00:00:00Z` (from March 1st to now)
 *
 * @see Dodopayments\Subscriptions->retrieveUsageHistory
 *
 * @phpstan-type SubscriptionRetrieveUsageHistoryParamsShape = array{
 *   endDate?: \DateTimeInterface|null,
 *   meterID?: string|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   startDate?: \DateTimeInterface|null,
 * }
 */
final class SubscriptionRetrieveUsageHistoryParams implements BaseModel
{
    /** @use SdkModel<SubscriptionRetrieveUsageHistoryParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by end date (inclusive).
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $endDate;

    /**
     * Filter by specific meter ID.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $meterID;

    /**
     * Page number (default: 0).
     */
    #[Api(nullable: true, optional: true)]
    public ?int $pageNumber;

    /**
     * Page size (default: 10, max: 100).
     */
    #[Api(nullable: true, optional: true)]
    public ?int $pageSize;

    /**
     * Filter by start date (inclusive).
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $startDate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?\DateTimeInterface $endDate = null,
        ?string $meterID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?\DateTimeInterface $startDate = null,
    ): self {
        $obj = new self;

        null !== $endDate && $obj->endDate = $endDate;
        null !== $meterID && $obj->meterID = $meterID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $startDate && $obj->startDate = $startDate;

        return $obj;
    }

    /**
     * Filter by end date (inclusive).
     */
    public function withEndDate(?\DateTimeInterface $endDate): self
    {
        $obj = clone $this;
        $obj->endDate = $endDate;

        return $obj;
    }

    /**
     * Filter by specific meter ID.
     */
    public function withMeterID(?string $meterID): self
    {
        $obj = clone $this;
        $obj->meterID = $meterID;

        return $obj;
    }

    /**
     * Page number (default: 0).
     */
    public function withPageNumber(?int $pageNumber): self
    {
        $obj = clone $this;
        $obj->pageNumber = $pageNumber;

        return $obj;
    }

    /**
     * Page size (default: 10, max: 100).
     */
    public function withPageSize(?int $pageSize): self
    {
        $obj = clone $this;
        $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Filter by start date (inclusive).
     */
    public function withStartDate(?\DateTimeInterface $startDate): self
    {
        $obj = clone $this;
        $obj->startDate = $startDate;

        return $obj;
    }
}
