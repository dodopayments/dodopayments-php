<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new UsageEventListParams); // set properties as needed
 * $client->usageEvents->list(...$params->toArray());
 * ```
 * Fetch events from your account with powerful filtering capabilities. This endpoint is ideal for:
 * - Debugging event ingestion issues
 * - Analyzing customer usage patterns
 * - Building custom analytics dashboards
 * - Auditing billing-related events.
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
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->usageEvents->list(...$params->toArray());`
 *
 * @see Dodopayments\UsageEvents->list
 *
 * @phpstan-type usage_event_list_params = array{
 *   customerID?: string,
 *   end?: \DateTimeInterface,
 *   eventName?: string,
 *   meterID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
 *   start?: \DateTimeInterface,
 * }
 */
final class UsageEventListParams implements BaseModel
{
    /** @use SdkModel<usage_event_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter events by customer ID.
     */
    #[Api(optional: true)]
    public ?string $customerID;

    /**
     * Filter events created before this timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $end;

    /**
     * Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name.
     */
    #[Api(optional: true)]
    public ?string $eventName;

    /**
     * Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned.
     */
    #[Api(optional: true)]
    public ?string $meterID;

    /**
     * Page number (0-based, default: 0).
     */
    #[Api(optional: true)]
    public ?int $pageNumber;

    /**
     * Number of events to return per page (default: 10).
     */
    #[Api(optional: true)]
    public ?int $pageSize;

    /**
     * Filter events created after this timestamp.
     */
    #[Api(optional: true)]
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
        ?string $customerID = null,
        ?\DateTimeInterface $end = null,
        ?string $eventName = null,
        ?string $meterID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?\DateTimeInterface $start = null,
    ): self {
        $obj = new self;

        null !== $customerID && $obj->customerID = $customerID;
        null !== $end && $obj->end = $end;
        null !== $eventName && $obj->eventName = $eventName;
        null !== $meterID && $obj->meterID = $meterID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $start && $obj->start = $start;

        return $obj;
    }

    /**
     * Filter events by customer ID.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    /**
     * Filter events created before this timestamp.
     */
    public function withEnd(\DateTimeInterface $end): self
    {
        $obj = clone $this;
        $obj->end = $end;

        return $obj;
    }

    /**
     * Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name.
     */
    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj->eventName = $eventName;

        return $obj;
    }

    /**
     * Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned.
     */
    public function withMeterID(string $meterID): self
    {
        $obj = clone $this;
        $obj->meterID = $meterID;

        return $obj;
    }

    /**
     * Page number (0-based, default: 0).
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->pageNumber = $pageNumber;

        return $obj;
    }

    /**
     * Number of events to return per page (default: 10).
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Filter events created after this timestamp.
     */
    public function withStart(\DateTimeInterface $start): self
    {
        $obj = clone $this;
        $obj->start = $start;

        return $obj;
    }
}
