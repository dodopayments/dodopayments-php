<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
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
     *
     * @return Event<HasRawResponse>
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
     * @return Event<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $eventID,
        mixed $params,
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
     *
     * @throws APIException
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
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<Event>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param list<EventInput> $events List of events to be pushed
     *
     * @return UsageEventIngestResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function ingest(
        $events,
        ?RequestOptions $requestOptions = null
    ): UsageEventIngestResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return UsageEventIngestResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function ingestRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): UsageEventIngestResponse;
}
