<?php

declare(strict_types=1);

namespace Dodopayments\Payouts;

use Dodopayments\Client;
use Dodopayments\Contracts\PayoutsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Payouts\PayoutListResponse;

final class PayoutsService implements PayoutsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $pageNumber = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null
    ): PayoutListResponse {
        [$parsed, $options] = PayoutListParams::parseRequest(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize],
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'payouts',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(PayoutListResponse::class, value: $resp);
    }
}
