<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\UsageEvents\Event;
use Dodopayments\UsageEvents\EventInput;
use Dodopayments\UsageEvents\UsageEventIngestResponse;

/**
 * @phpstan-import-type EventInputShape from \Dodopayments\UsageEvents\EventInput
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface UsageEventsContract
{
    /**
     * @api
     *
     * @param string $eventID Unique event identifier (case-sensitive, must match the ID used during ingestion)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): Event;

    /**
     * @api
     *
     * @param string $customerID Filter events by customer ID
     * @param \DateTimeInterface $end Filter events created before this timestamp
     * @param string $eventName Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name
     * @param string $meterID Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned
     * @param int $pageNumber Page number (0-based, default: 0)
     * @param int $pageSize Number of events to return per page (default: 10)
     * @param \DateTimeInterface $start Filter events created after this timestamp
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<Event>
     *
     * @throws APIException
     */
    public function list(
        ?string $customerID = null,
        ?\DateTimeInterface $end = null,
        ?string $eventName = null,
        ?string $meterID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?\DateTimeInterface $start = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param list<EventInput|EventInputShape> $events List of events to be pushed
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function ingest(
        array $events,
        RequestOptions|array|null $requestOptions = null
    ): UsageEventIngestResponse;
}
