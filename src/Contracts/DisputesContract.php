<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Disputes\DisputeListResponse;

interface DisputesContract
{
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): GetDispute;

    /**
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param DisputeStage::* $disputeStage Filter by dispute stage
     * @param DisputeStatus::* $disputeStatus Filter by dispute status
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $createdAtGte = null,
        $createdAtLte = null,
        $customerID = null,
        $disputeStage = null,
        $disputeStatus = null,
        $pageNumber = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DisputeListResponse;
}
