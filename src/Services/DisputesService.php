<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DisputesContract;

final class DisputesService implements DisputesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): GetDispute {
        // @phpstan-ignore-next-line;
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
     *   created_at_gte?: string|\DateTimeInterface,
     *   created_at_lte?: string|\DateTimeInterface,
     *   customer_id?: string,
     *   dispute_stage?: 'pre_dispute'|'dispute'|'pre_arbitration',
     *   dispute_status?: value-of<DisputeStatus>,
     *   page_number?: int,
     *   page_size?: int,
     * }|DisputeListParams $params
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|DisputeListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = DisputeListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'disputes',
            query: $parsed,
            options: $options,
            convert: DisputeListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
