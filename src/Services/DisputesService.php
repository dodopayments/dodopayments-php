<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\DisputesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\Disputes\DisputeListParams;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\GetDispute;
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
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param DisputeStage::* $disputeStage Filter by dispute stage
     * @param DisputeStatus::* $disputeStatus Filter by dispute status
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $createdAtGte = null,
        $createdAtLte = null,
        $customerID = null,
        $disputeStage = null,
        $disputeStatus = null,
        $pageNumber = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DisputeListResponse {
        $args = [
            'createdAtGte' => $createdAtGte,
            'createdAtLte' => $createdAtLte,
            'customerID' => $customerID,
            'disputeStage' => $disputeStage,
            'disputeStatus' => $disputeStatus,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'createdAtGte',
                'createdAtLte',
                'customerID',
                'disputeStage',
                'disputeStatus',
                'pageNumber',
                'pageSize',
            ],
        );
        [$parsed, $options] = DisputeListParams::parseRequest(
            $args,
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
