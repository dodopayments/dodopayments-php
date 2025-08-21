<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\RefundsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\RequestOptions;

final class RefundsService implements RefundsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param string $paymentID the unique identifier of the payment to be refunded
     * @param list<Item>|null $items Partially Refund an Individual Item
     * @param string|null $reason The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     */
    public function create(
        $paymentID,
        $items = null,
        $reason = null,
        ?RequestOptions $requestOptions = null,
    ): Refund {
        $args = ['paymentID' => $paymentID, 'items' => $items, 'reason' => $reason];
        $args = Util::array_filter_null($args, ['items', 'reason']);
        [$parsed, $options] = RefundCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'refunds',
            body: (object) $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Refund::class, value: $resp);
    }

    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund {
        $resp = $this->client->request(
            method: 'get',
            path: ['refunds/%1$s', $refundID],
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Refund::class, value: $resp);
    }

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
    ): Refund {
        $args = [
            'createdAtGte' => $createdAtGte,
            'createdAtLte' => $createdAtLte,
            'customerID' => $customerID,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
            'status' => $status,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'createdAtGte',
                'createdAtLte',
                'customerID',
                'pageNumber',
                'pageSize',
                'status',
            ],
        );
        [$parsed, $options] = RefundListParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'refunds',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Refund::class, value: $resp);
    }
}
