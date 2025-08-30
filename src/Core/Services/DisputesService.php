<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\DisputesContract;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class DisputesService implements DisputesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
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
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param DisputeStage::* $disputeStage Filter by dispute stage
     * @param DisputeStatus::* $disputeStatus Filter by dispute status
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     */
    public function list(
        $createdAtGte = omit,
        $createdAtLte = omit,
        $customerID = omit,
        $disputeStage = omit,
        $disputeStatus = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = DisputeListParams::parseRequest(
            [
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'customerID' => $customerID,
                'disputeStage' => $disputeStage,
                'disputeStatus' => $disputeStatus,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
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
