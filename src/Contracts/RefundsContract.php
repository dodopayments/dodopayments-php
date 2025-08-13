<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\RequestOptions;

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
