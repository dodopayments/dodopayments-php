<?php

declare(strict_types=1);

namespace Dodopayments\Core\ServiceContracts;

use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface RefundsContract
{
    /**
     * @api
     *
     * @param string $paymentID the unique identifier of the payment to be refunded
     * @param list<Item>|null $items Partially Refund an Individual Item
     * @param string|null $reason The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    public function create(
        $paymentID,
        $items = omit,
        $reason = omit,
        ?RequestOptions $requestOptions = null,
    ): Refund;

    /**
     * @api
     */
    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund;

    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param Status::* $status Filter by status
     *
     * @return DefaultPageNumberPagination<Refund>
     */
    public function list(
        $createdAtGte = omit,
        $createdAtLte = omit,
        $customerID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $status = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
