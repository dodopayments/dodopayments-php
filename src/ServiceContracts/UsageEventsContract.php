<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\UsageEvents\Event;
use Dodopayments\UsageEvents\EventInput;
use Dodopayments\UsageEvents\UsageEventIngestResponse;

use const Dodopayments\Core\OMIT as omit;

interface UsageEventsContract
{
    /**
     * @api
     */
    public function retrieve(
        string $eventID,
        ?RequestOptions $requestOptions = null
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
     *
     * @return DefaultPageNumberPagination<Event>
     */
    public function list(
        $customerID = omit,
        $end = omit,
        $eventName = omit,
        $meterID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $start = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param list<EventInput> $events List of events to be pushed
     */
    public function ingest(
        $events,
        ?RequestOptions $requestOptions = null
    ): UsageEventIngestResponse;
}
