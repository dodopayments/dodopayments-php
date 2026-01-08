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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface UsageEventsRawContract
{
    /**
     * @api
     *
     * @param string $eventID Unique event identifier (case-sensitive, must match the ID used during ingestion)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Event>
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|UsageEventListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Event>>
     *
     * @throws APIException
     */
    public function list(
        array|UsageEventListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|UsageEventIngestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UsageEventIngestResponse>
     *
     * @throws APIException
     */
    public function ingest(
        array|UsageEventIngestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
