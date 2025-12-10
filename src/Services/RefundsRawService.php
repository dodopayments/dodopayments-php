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
use Dodopayments\ServiceContracts\RefundsRawContract;

final class RefundsRawService implements RefundsRawContract
{
    // @phpstan-ignore-next-line
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
     * @return BaseResponse<Refund>
     *
     * @throws APIException
     */
    public function create(
        array|RefundCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = RefundCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param string $refundID Refund Id
     *
     * @return BaseResponse<Refund>
     *
     * @throws APIException
     */
    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
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
     *   createdAtGte?: string|\DateTimeInterface,
     *   createdAtLte?: string|\DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: 'succeeded'|'failed'|'pending'|'review'|Status,
     * }|RefundListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<RefundListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|RefundListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = RefundListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
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
    }
}
