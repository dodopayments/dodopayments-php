<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\RefundsContract;

use const Dodopayments\Core\OMIT as omit;

final class RefundsService implements RefundsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
    ): Refund {
        [$parsed, $options] = RefundCreateParams::parseRequest(
            ['paymentID' => $paymentID, 'items' => $items, 'reason' => $reason],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'refunds',
            body: (object) $parsed,
            options: $options,
            convert: Refund::class,
        );
    }

    /**
     * @api
     */
    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['refunds/%1$s', $refundID],
            options: $requestOptions,
            convert: Refund::class,
        );
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
    ): DefaultPageNumberPagination {
        [$parsed, $options] = RefundListParams::parseRequest(
            [
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'status' => $status,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'refunds',
            query: $parsed,
            options: $options,
            convert: Refund::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
