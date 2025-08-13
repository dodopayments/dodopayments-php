<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Refunds\Refund;
use DodopaymentsClient\Refunds\RefundCreateParams;
use DodopaymentsClient\Refunds\RefundCreateParams\Item;
use DodopaymentsClient\Refunds\RefundListParams;
use DodopaymentsClient\Refunds\RefundListParams\Status;
use DodopaymentsClient\RequestOptions;

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
