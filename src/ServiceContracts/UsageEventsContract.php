<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\UsageEvents\Event;
use Dodopayments\UsageEvents\UsageEventIngestParams;
use Dodopayments\UsageEvents\UsageEventIngestResponse;
use Dodopayments\UsageEvents\UsageEventListParams;

interface UsageEventsContract
{
    /**
     * @api
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
     * @param array<mixed>|UsageEventListParams $params
     *
     * @return DefaultPageNumberPagination<Event>
     *
     * @throws APIException
     */
    public function list(
        array|UsageEventListParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param array<mixed>|UsageEventIngestParams $params
     *
     * @throws APIException
     */
    public function ingest(
        array|UsageEventIngestParams $params,
        ?RequestOptions $requestOptions = null,
    ): UsageEventIngestResponse;
}
