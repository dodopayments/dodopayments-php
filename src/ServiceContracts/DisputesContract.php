<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;

interface DisputesContract
{
    /**
     * @api
     *
     * @param string $disputeID Dispute Id
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): GetDispute;

    /**
     * @api
     *
     * @param string|\DateTimeInterface $createdAtGte Get events after this created time
     * @param string|\DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param 'pre_dispute'|'dispute'|'pre_arbitration'|DisputeStage $disputeStage Filter by dispute stage
     * @param 'dispute_opened'|'dispute_expired'|'dispute_accepted'|'dispute_cancelled'|'dispute_challenged'|'dispute_won'|'dispute_lost'|DisputeStatus $disputeStatus Filter by dispute status
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     *
     * @throws APIException
     */
    public function list(
        string|\DateTimeInterface|null $createdAtGte = null,
        string|\DateTimeInterface|null $createdAtLte = null,
        ?string $customerID = null,
        string|DisputeStage|null $disputeStage = null,
        string|DisputeStatus|null $disputeStatus = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
