<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Fetch events from your account with powerful filtering capabilities. This endpoint is ideal for:
 * - Debugging event ingestion issues
 * - Analyzing customer usage patterns
 * - Building custom analytics dashboards
 * - Auditing billing-related events
 *
 * ## Filtering Options:
 * - **Customer filtering**: Filter by specific customer ID
 * - **Event name filtering**: Filter by event type/name
 * - **Meter-based filtering**: Use a meter ID to apply the meter's event name and filter criteria automatically
 * - **Time range filtering**: Filter events within a specific date range
 * - **Pagination**: Navigate through large result sets
 *
 * ## Meter Integration:
 * When using `meter_id`, the endpoint automatically applies:
 * - The meter's configured `event_name` filter
 * - The meter's custom filter criteria (if any)
 * - If you also provide `event_name`, it must match the meter's event name
 *
 * ## Example Queries:
 * - Get all events for a customer: `?customer_id=cus_abc123`
 * - Get API request events: `?event_name=api_request`
 * - Get events from last 24 hours: `?start=2024-01-14T10:30:00Z&end=2024-01-15T10:30:00Z`
 * - Get events with meter filtering: `?meter_id=mtr_xyz789`
 * - Paginate results: `?page_size=50&page_number=2`
 *
 * @see Dodopayments\Services\UsageEventsService::list()
 *
 * @phpstan-type UsageEventListParamsShape = array{
 *   customer_id?: string,
 *   end?: \DateTimeInterface,
 *   event_name?: string,
 *   meter_id?: string,
 *   page_number?: int,
 *   page_size?: int,
 *   start?: \DateTimeInterface,
 * }
 */
final class UsageEventListParams implements BaseModel
{
    /** @use SdkModel<UsageEventListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter events by customer ID.
     */
    #[Optional]
    public ?string $customer_id;

    /**
     * Filter events created before this timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $end;

    /**
     * Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name.
     */
    #[Optional]
    public ?string $event_name;

    /**
     * Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned.
     */
    #[Optional]
    public ?string $meter_id;

    /**
     * Page number (0-based, default: 0).
     */
    #[Optional]
    public ?int $page_number;

    /**
     * Number of events to return per page (default: 10).
     */
    #[Optional]
    public ?int $page_size;

    /**
     * Filter events created after this timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $start;

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
        ?string $customer_id = null,
        ?\DateTimeInterface $end = null,
        ?string $event_name = null,
        ?string $meter_id = null,
        ?int $page_number = null,
        ?int $page_size = null,
        ?\DateTimeInterface $start = null,
    ): self {
        $obj = new self;

        null !== $customer_id && $obj['customer_id'] = $customer_id;
        null !== $end && $obj['end'] = $end;
        null !== $event_name && $obj['event_name'] = $event_name;
        null !== $meter_id && $obj['meter_id'] = $meter_id;
        null !== $page_number && $obj['page_number'] = $page_number;
        null !== $page_size && $obj['page_size'] = $page_size;
        null !== $start && $obj['start'] = $start;

        return $obj;
    }

    /**
     * Filter events by customer ID.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customer_id'] = $customerID;

        return $obj;
    }

    /**
     * Filter events created before this timestamp.
     */
    public function withEnd(\DateTimeInterface $end): self
    {
        $obj = clone $this;
        $obj['end'] = $end;

        return $obj;
    }

    /**
     * Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name.
     */
    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj['event_name'] = $eventName;

        return $obj;
    }

    /**
     * Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned.
     */
    public function withMeterID(string $meterID): self
    {
        $obj = clone $this;
        $obj['meter_id'] = $meterID;

        return $obj;
    }

    /**
     * Page number (0-based, default: 0).
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj['page_number'] = $pageNumber;

        return $obj;
    }

    /**
     * Number of events to return per page (default: 10).
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj['page_size'] = $pageSize;

        return $obj;
    }

    /**
     * Filter events created after this timestamp.
     */
    public function withStart(\DateTimeInterface $start): self
    {
        $obj = clone $this;
        $obj['start'] = $start;

        return $obj;
    }
}
