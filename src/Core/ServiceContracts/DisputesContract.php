<?php

declare(strict_types=1);

namespace Dodopayments\Core\ServiceContracts;

use Dodopayments\Core\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

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
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     */
    public function list(
        $createdAtGte = omit,
        $createdAtLte = omit,
        $customerID = omit,
        $disputeStage = omit,
        $disputeStatus = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
