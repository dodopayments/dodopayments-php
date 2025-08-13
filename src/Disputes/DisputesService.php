<?php

declare(strict_types=1);

namespace DodopaymentsClient\Disputes;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\DisputesContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\Disputes\DisputeListParams\DisputeStage as DisputeStage1;
use DodopaymentsClient\Disputes\DisputeListParams\DisputeStatus as DisputeStatus1;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Disputes\DisputeListResponse;

final class DisputesService implements DisputesContract
{
    public function __construct(private Client $client) {}

    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): GetDispute {
        $resp = $this->client->request(
            method: 'get',
            path: ['disputes/%1$s', $disputeID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(GetDispute::class, value: $resp);
    }

    /**
     * @param array{
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   disputeStage?: DisputeStage1::*,
     *   disputeStatus?: DisputeStatus1::*,
     *   pageNumber?: int,
     *   pageSize?: int,
     * }|DisputeListParams $params
     */
    public function list(
        array|DisputeListParams $params,
        ?RequestOptions $requestOptions = null
    ): DisputeListResponse {
        [$parsed, $options] = DisputeListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'disputes',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DisputeListResponse::class, value: $resp);
    }
}
