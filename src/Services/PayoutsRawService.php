<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListParams;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\PayoutsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class PayoutsRawService implements PayoutsRawContract
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
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   pageNumber?: int,
     *   pageSize?: int,
     * }|PayoutListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<PayoutListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PayoutListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PayoutListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payouts',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: PayoutListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
