<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListParams;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\PayoutsContract;

use const Dodopayments\Core\OMIT as omit;

final class PayoutsService implements PayoutsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get payouts created after this time (inclusive)
     * @param \DateTimeInterface $createdAtLte Get payouts created before this time (inclusive)
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<PayoutListResponse>
     *
     * @throws APIException
     */
    public function list(
        $createdAtGte = omit,
        $createdAtLte = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = [
            'createdAtGte' => $createdAtGte,
            'createdAtLte' => $createdAtLte,
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
     * @return DefaultPageNumberPagination<PayoutListResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = PayoutListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'payouts',
            query: $parsed,
            options: $options,
            convert: PayoutListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
