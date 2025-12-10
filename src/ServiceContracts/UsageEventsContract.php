<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\UsageEvents\Event;
use Dodopayments\UsageEvents\UsageEventIngestResponse;

interface UsageEventsContract
{
    /**
     * @api
     *
     * @param string $eventID Unique event identifier (case-sensitive, must match the ID used during ingestion)
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        ?RequestOptions $requestOptions = null
    ): Event;

    /**
     * @api
     *
     * @param string $customerID Filter events by customer ID
     * @param string|\DateTimeInterface $end Filter events created before this timestamp
     * @param string $eventName Filter events by event name. If both event_name and meter_id are provided, they must match the meter's configured event_name
     * @param string $meterID Filter events by meter ID. When provided, only events that match the meter's event_name and filter criteria will be returned
     * @param int $pageNumber Page number (0-based, default: 0)
     * @param int $pageSize Number of events to return per page (default: 10)
     * @param string|\DateTimeInterface $start Filter events created after this timestamp
     *
     * @return DefaultPageNumberPagination<Event>
     *
     * @throws APIException
     */
    public function list(
        ?string $customerID = null,
        string|\DateTimeInterface|null $end = null,
        ?string $eventName = null,
        ?string $meterID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        string|\DateTimeInterface|null $start = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param list<array{
     *   customerID: string,
     *   eventID: string,
     *   eventName: string,
     *   metadata?: array<string,string|float|bool>|null,
     *   timestamp?: string|\DateTimeInterface|null,
     * }> $events List of events to be pushed
     *
     * @throws APIException
     */
    public function ingest(
        array $events,
        ?RequestOptions $requestOptions = null
    ): UsageEventIngestResponse;
}
