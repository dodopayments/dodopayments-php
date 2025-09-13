<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DisputesContract;

use const Dodopayments\Core\OMIT as omit;

final class DisputesService implements DisputesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @return GetDispute<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): GetDispute {
        $params = [];

        return $this->retrieveRaw($disputeID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return GetDispute<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $disputeID,
        mixed $params,
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
     * @param DisputeStage|value-of<DisputeStage> $disputeStage Filter by dispute stage
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus Filter by dispute status
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     *
     * @throws APIException
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
        $params = [
            'createdAtGte' => $createdAtGte,
            'createdAtLte' => $createdAtLte,
            'customerID' => $customerID,
            'disputeStage' => $disputeStage,
            'disputeStatus' => $disputeStatus,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
        ];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = DisputeListParams::parseRequest(
            $params,
            $requestOptions
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
