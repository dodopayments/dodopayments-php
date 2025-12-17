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
 *   customerID?: string|null,
 *   end?: \DateTimeInterface|null,
 *   eventName?: string|null,
 *   meterID?: string|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   start?: \DateTimeInterface|null,
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
    public ?string $customerID;

    /**
     * Filter events created before this timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $end;

    /**
     * Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name.
     */
    #[Optional]
    public ?string $eventName;

    /**
     * Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned.
     */
    #[Optional]
    public ?string $meterID;

    /**
     * Page number (0-based, default: 0).
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Number of events to return per page (default: 10).
     */
    #[Optional]
    public ?int $pageSize;

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
        ?string $customerID = null,
        ?\DateTimeInterface $end = null,
        ?string $eventName = null,
        ?string $meterID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?\DateTimeInterface $start = null,
    ): self {
        $self = new self;

        null !== $customerID && $self['customerID'] = $customerID;
        null !== $end && $self['end'] = $end;
        null !== $eventName && $self['eventName'] = $eventName;
        null !== $meterID && $self['meterID'] = $meterID;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    /**
     * Filter events by customer ID.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Filter events created before this timestamp.
     */
    public function withEnd(\DateTimeInterface $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name.
     */
    public function withEventName(string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    /**
     * Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned.
     */
    public function withMeterID(string $meterID): self
    {
        $self = clone $this;
        $self['meterID'] = $meterID;

        return $self;
    }

    /**
     * Page number (0-based, default: 0).
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Number of events to return per page (default: 10).
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter events created after this timestamp.
     */
    public function withStart(\DateTimeInterface $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
