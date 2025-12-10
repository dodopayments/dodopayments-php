<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DisputesRawContract;

final class DisputesRawService implements DisputesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $disputeID Dispute Id
     *
     * @return BaseResponse<GetDispute>
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['disputes/%1$s', $disputeID],
            options: $requestOptions,
            convert: GetDispute::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   createdAtGte?: string|\DateTimeInterface,
     *   createdAtLte?: string|\DateTimeInterface,
     *   customerID?: string,
     *   disputeStage?: 'pre_dispute'|'dispute'|'pre_arbitration'|DisputeStage,
     *   disputeStatus?: value-of<DisputeStatus>,
     *   pageNumber?: int,
     *   pageSize?: int,
     * }|DisputeListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<DisputeListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|DisputeListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = DisputeListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'disputes',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'customerID' => 'customer_id',
                    'disputeStage' => 'dispute_stage',
                    'disputeStatus' => 'dispute_status',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: DisputeListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
