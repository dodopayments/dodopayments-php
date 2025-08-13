<?php

declare(strict_types=1);

namespace DodoPayments\Payouts;

use DodoPayments\Client;
use DodoPayments\Contracts\PayoutsContract;
use DodoPayments\Core\Conversion;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Payouts\PayoutListResponse;

final class PayoutsService implements PayoutsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{pageNumber?: int, pageSize?: int}|PayoutListParams $params
     */
    public function list(
        array|PayoutListParams $params,
        ?RequestOptions $requestOptions = null
    ): PayoutListResponse {
        [$parsed, $options] = PayoutListParams::parseRequest(
            $params,
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
