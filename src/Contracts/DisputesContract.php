<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Disputes\DisputeListParams;
use DodoPayments\Disputes\DisputeListParams\DisputeStage;
use DodoPayments\Disputes\DisputeListParams\DisputeStatus;
use DodoPayments\Disputes\GetDispute;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Disputes\DisputeListResponse;

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
