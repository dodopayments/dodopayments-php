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
