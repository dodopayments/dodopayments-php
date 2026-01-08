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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface DisputesContract
{
    /**
     * @api
     *
     * @param string $disputeID Dispute Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        RequestOptions|array|null $requestOptions = null
    ): GetDispute;

    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param DisputeStage|value-of<DisputeStage> $disputeStage Filter by dispute stage
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus Filter by dispute status
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        DisputeStage|string|null $disputeStage = null,
        DisputeStatus|string|null $disputeStatus = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
