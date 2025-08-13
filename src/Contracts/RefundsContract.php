<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Refunds\Refund;
use DodoPayments\Refunds\RefundCreateParams;
use DodoPayments\Refunds\RefundCreateParams\Item;
use DodoPayments\Refunds\RefundListParams;
use DodoPayments\Refunds\RefundListParams\Status;
use DodoPayments\RequestOptions;

interface RefundsContract
{
    /**
     * @param array{
     *   paymentID: string, items?: null|list<Item>, reason?: null|string
     * }|RefundCreateParams $params
     */
    public function create(
        array|RefundCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Refund;

    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund;

    /**
     * @param array{
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: Status::*,
     * }|RefundListParams $params
     */
    public function list(
        array|RefundListParams $params,
        ?RequestOptions $requestOptions = null
    ): Refund;
}
