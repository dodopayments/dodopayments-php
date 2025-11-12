<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\RefundsContract;

final class RefundsService implements RefundsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   payment_id: string,
     *   items?: list<array{
     *     item_id: string, amount?: int|null, tax_inclusive?: bool
     *   }>|null,
     *   metadata?: array<string,string>,
     *   reason?: string|null,
     * }|RefundCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|RefundCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Refund {
        [$parsed, $options] = RefundCreateParams::parseRequest(
            $params,
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
     *
     * @throws APIException
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
     * @param array{
     *   created_at_gte?: string|\DateTimeInterface,
     *   created_at_lte?: string|\DateTimeInterface,
     *   customer_id?: string,
     *   page_number?: int,
     *   page_size?: int,
     *   status?: "succeeded"|"failed"|"pending"|"review",
     * }|RefundListParams $params
     *
     * @return DefaultPageNumberPagination<RefundListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RefundListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = RefundListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'refunds',
            query: $parsed,
            options: $options,
            convert: RefundListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
