<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\UsageEvents\Event;
use Dodopayments\UsageEvents\UsageEventIngestParams;
use Dodopayments\UsageEvents\UsageEventIngestResponse;
use Dodopayments\UsageEvents\UsageEventListParams;

interface UsageEventsRawContract
{
    /**
     * @api
     *
     * @param string $eventID Unique event identifier (case-sensitive, must match the ID used during ingestion)
     *
     * @return BaseResponse<Event>
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|UsageEventListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<Event>>
     *
     * @throws APIException
     */
    public function list(
        array|UsageEventListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|UsageEventIngestParams $params
     *
     * @return BaseResponse<UsageEventIngestResponse>
     *
     * @throws APIException
     */
    public function ingest(
        array|UsageEventIngestParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
