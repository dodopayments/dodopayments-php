<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\Refunds\RefundListResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type ItemShape from \Dodopayments\Refunds\RefundCreateParams\Item
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface RefundsContract
{
    /**
     * @api
     *
     * @param string $paymentID the unique identifier of the payment to be refunded
     * @param list<Item|ItemShape>|null $items Partially Refund an Individual Item
     * @param array<string,string> $metadata additional metadata associated with the refund
     * @param string|null $reason The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $paymentID,
        ?array $items = null,
        ?array $metadata = null,
        ?string $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): Refund;

    /**
     * @api
     *
     * @param string $refundID Refund Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $refundID,
        RequestOptions|array|null $requestOptions = null
    ): Refund;

    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param Status|value-of<Status> $status Filter by status
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<RefundListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
