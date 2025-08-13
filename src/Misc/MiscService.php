<?php

declare(strict_types=1);

namespace DodopaymentsClient\Misc;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\MiscContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\Core\Conversion\ListOf;
use DodopaymentsClient\RequestOptions;

final class MiscService implements MiscContract
{
    public function __construct(private Client $client) {}

    /**
     * @return list<CountryCode::*>
     */
    public function listSupportedCountries(
        ?RequestOptions $requestOptions = null
    ): array {
        $resp = $this->client->request(
            method: 'get',
            path: 'checkout/supported_countries',
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(new ListOf(CountryCode::class), value: $resp);
    }
}
