<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

use Dodopayments\Client;
use Dodopayments\Contracts\DisputesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Disputes\DisputeListResponse;

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
     *   disputeStage?: DisputeStage::*,
     *   disputeStatus?: DisputeStatus::*,
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
