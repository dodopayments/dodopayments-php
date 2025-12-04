<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\UsageEventsContract;
use Dodopayments\UsageEvents\Event;
use Dodopayments\UsageEvents\UsageEventIngestParams;
use Dodopayments\UsageEvents\UsageEventIngestResponse;
use Dodopayments\UsageEvents\UsageEventListParams;

final class UsageEventsService implements UsageEventsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Fetch detailed information about a single event using its unique event ID. This endpoint is useful for:
     * - Debugging specific event ingestion issues
     * - Retrieving event details for customer support
     * - Validating that events were processed correctly
     * - Getting the complete metadata for an event
     *
     * ## Event ID Format:
     * The event ID should be the same value that was provided during event ingestion via the `/events/ingest` endpoint.
     * Event IDs are case-sensitive and must match exactly.
     *
     * ## Response Details:
     * The response includes all event data including:
     * - Complete metadata key-value pairs
     * - Original timestamp (preserved from ingestion)
     * - Customer and business association
     * - Event name and processing information
     *
     * ## Example Usage:
     * ```text
     * GET /events/api_call_12345
     * ```
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        ?RequestOptions $requestOptions = null
    ): Event {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['events/%1$s', $eventID],
            options: $requestOptions,
            convert: Event::class,
        );
    }

    /**
     * @api
     *
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
     * @param array{
     *   customer_id?: string,
     *   end?: string|\DateTimeInterface,
     *   event_name?: string,
     *   meter_id?: string,
     *   page_number?: int,
     *   page_size?: int,
     *   start?: string|\DateTimeInterface,
     * }|UsageEventListParams $params
     *
     * @return DefaultPageNumberPagination<Event>
     *
     * @throws APIException
     */
    public function list(
        array|UsageEventListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = UsageEventListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'events',
            query: $parsed,
            options: $options,
            convert: Event::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * This endpoint allows you to ingest custom events that can be used for:
     * - Usage-based billing and metering
     * - Analytics and reporting
     * - Customer behavior tracking
     *
     * ## Important Notes:
     * - **Duplicate Prevention**:
     *   - Duplicate `event_id` values within the same request are rejected (entire request fails)
     *   - Subsequent requests with existing `event_id` values are ignored (idempotent behavior)
     * - **Rate Limiting**: Maximum 1000 events per request
     * - **Time Validation**: Events with timestamps older than 1 hour or more than 5 minutes in the future will be rejected
     * - **Metadata Limits**: Maximum 50 key-value pairs per event, keys max 100 chars, values max 500 chars
     *
     * ## Example Usage:
     * ```json
     * {
     *   "events": [
     *     {
     *       "event_id": "api_call_12345",
     *       "customer_id": "cus_abc123",
     *       "event_name": "api_request",
     *       "timestamp": "2024-01-15T10:30:00Z",
     *       "metadata": {
     *         "endpoint": "/api/v1/users",
     *         "method": "GET",
     *         "tokens_used": "150"
     *       }
     *     }
     *   ]
     * }
     * ```
     *
     * @param array{
     *   events: list<array{
     *     customer_id: string,
     *     event_id: string,
     *     event_name: string,
     *     metadata?: array<string,string|float|bool>|null,
     *     timestamp?: string|\DateTimeInterface|null,
     *   }>,
     * }|UsageEventIngestParams $params
     *
     * @throws APIException
     */
    public function ingest(
        array|UsageEventIngestParams $params,
        ?RequestOptions $requestOptions = null
    ): UsageEventIngestResponse {
        [$parsed, $options] = UsageEventIngestParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'events/ingest',
            body: (object) $parsed,
            options: $options,
            convert: UsageEventIngestResponse::class,
        );
    }
}
