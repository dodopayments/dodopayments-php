<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Disputes\DisputeListParams;
use DodopaymentsClient\Disputes\DisputeListParams\DisputeStage;
use DodopaymentsClient\Disputes\DisputeListParams\DisputeStatus;
use DodopaymentsClient\Disputes\GetDispute;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Disputes\DisputeListResponse;

interface DisputesContract
{
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): GetDispute;

    /**
     * @param array{
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   disputeStage?: DisputeStage::*,
     *   disputeStatus?: DisputeStatus::*,
     *   pageNumber?: int,
     *   pageSize?: int,
     * }|DisputeListParams $params
     */
    public function list(
        array|DisputeListParams $params,
        ?RequestOptions $requestOptions = null
    ): DisputeListResponse;
}
