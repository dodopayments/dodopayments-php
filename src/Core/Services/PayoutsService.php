<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\Pagination\DefaultPageNumberPagination;
use Dodopayments\Core\ServiceContracts\PayoutsContract;
use Dodopayments\Payouts\PayoutListParams;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class PayoutsService implements PayoutsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): PayoutListResponse {
        [$parsed, $options] = PayoutListParams::parseRequest(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize],
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
