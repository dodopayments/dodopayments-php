<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\Refunds\RefundListResponse;
use Dodopayments\RequestOptions;

interface RefundsContract
{
    /**
     * @api
     *
     * @param string $paymentID the unique identifier of the payment to be refunded
     * @param list<array{
     *   itemID: string, amount?: int|null, taxInclusive?: bool
     * }>|null $items Partially Refund an Individual Item
     * @param array<string,string> $metadata additional metadata associated with the refund
     * @param string|null $reason The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     *
     * @throws APIException
     */
    public function create(
        string $paymentID,
        ?array $items = null,
        ?array $metadata = null,
        ?string $reason = null,
        ?RequestOptions $requestOptions = null,
    ): Refund;

    /**
     * @api
     *
     * @param string $refundID Refund Id
     *
     * @throws APIException
     */
    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund;

    /**
     * @api
     *
     * @param string|\DateTimeInterface $createdAtGte Get events after this created time
     * @param string|\DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param 'succeeded'|'failed'|'pending'|'review'|Status $status Filter by status
     *
     * @return DefaultPageNumberPagination<RefundListResponse>
     *
     * @throws APIException
     */
    public function list(
        string|\DateTimeInterface|null $createdAtGte = null,
        string|\DateTimeInterface|null $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        string|Status|null $status = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
