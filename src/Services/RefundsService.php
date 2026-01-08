<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\Refunds\RefundListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\RefundsContract;

/**
 * @phpstan-import-type ItemShape from \Dodopayments\Refunds\RefundCreateParams\Item
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class RefundsService implements RefundsContract
{
    /**
     * @api
     */
    public RefundsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RefundsRawService($client);
    }

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
    ): Refund {
        $params = Util::removeNulls(
            [
                'paymentID' => $paymentID,
                'items' => $items,
                'metadata' => $metadata,
                'reason' => $reason,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): Refund {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($refundID, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
