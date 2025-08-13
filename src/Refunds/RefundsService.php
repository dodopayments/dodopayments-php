<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Client;
use Dodopayments\Contracts\RefundsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\RequestOptions;

final class RefundsService implements RefundsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{
     *   paymentID: string, items?: null|list<Item>, reason?: null|string
     * }|RefundCreateParams $params
     */
    public function create(
        array|RefundCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Refund {
        [$parsed, $options] = RefundCreateParams::parseRequest(
            $params,
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
    ): Refund {
        [$parsed, $options] = RefundListParams::parseRequest(
            $params,
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
