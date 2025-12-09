<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListParams\Status;
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
     *   paymentID: string,
     *   items?: list<array{
     *     itemID: string, amount?: int|null, taxInclusive?: bool
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

        /** @var BaseResponse<Refund> */
        $response = $this->client->request(
            method: 'post',
            path: 'refunds',
            body: (object) $parsed,
            options: $options,
            convert: Refund::class,
        );

        return $response->parse();
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
        /** @var BaseResponse<Refund> */
        $response = $this->client->request(
            method: 'get',
            path: ['refunds/%1$s', $refundID],
            options: $requestOptions,
            convert: Refund::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   createdAtGte?: string|\DateTimeInterface,
     *   createdAtLte?: string|\DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: 'succeeded'|'failed'|'pending'|'review'|Status,
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

        /** @var BaseResponse<DefaultPageNumberPagination<RefundListResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'refunds',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'customerID' => 'customer_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: RefundListResponse::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }
}
