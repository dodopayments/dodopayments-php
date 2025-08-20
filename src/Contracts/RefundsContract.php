<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\RequestOptions;

interface RefundsContract
{
    /**
     * @param string $paymentID the unique identifier of the payment to be refunded
     * @param null|list<Item> $items Partially Refund an Individual Item
     * @param null|string $reason The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    public function create(
        $paymentID,
        $items = null,
        $reason = null,
        ?RequestOptions $requestOptions = null,
    ): Refund;

    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund;

    /**
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param Status::* $status Filter by status
     */
    public function list(
        $createdAtGte = null,
        $createdAtLte = null,
        $customerID = null,
        $pageNumber = null,
        $pageSize = null,
        $status = null,
        ?RequestOptions $requestOptions = null,
    ): Refund;
}
