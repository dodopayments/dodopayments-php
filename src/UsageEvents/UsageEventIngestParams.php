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
 * $params = (new UsageEventIngestParams); // set properties as needed
 * $client->usageEvents->ingest(...$params->toArray());
 * ```
 * This endpoint allows you to ingest custom events that can be used for:
 * - Usage-based billing and metering
 * - Analytics and reporting
 * - Customer behavior tracking.
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
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->usageEvents->ingest(...$params->toArray());`
 *
 * @see Dodopayments\UsageEvents->ingest
 *
 * @phpstan-type usage_event_ingest_params = array{events: list<EventInput>}
 */
final class UsageEventIngestParams implements BaseModel
{
    /** @use SdkModel<usage_event_ingest_params> */
    use SdkModel;
    use SdkParams;

    /**
     * List of events to be pushed.
     *
     * @var list<EventInput> $events
     */
    #[Api(list: EventInput::class)]
    public array $events;

    /**
     * `new UsageEventIngestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageEventIngestParams::with(events: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UsageEventIngestParams)->withEvents(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<EventInput> $events
     */
    public static function with(array $events): self
    {
        $obj = new self;

        $obj->events = $events;

        return $obj;
    }

    /**
     * List of events to be pushed.
     *
     * @param list<EventInput> $events
     */
    public function withEvents(array $events): self
    {
        $obj = clone $this;
        $obj->events = $events;

        return $obj;
    }
}
