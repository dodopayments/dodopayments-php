<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\ServiceContracts\MiscContract;
use Dodopayments\Misc\CountryCode;
use Dodopayments\RequestOptions;

final class MiscService implements MiscContract
{
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @return list<CountryCode::*>
     */
    public function listSupportedCountries(
        ?RequestOptions $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'checkout/supported_countries',
            options: $requestOptions,
            convert: new ListOf(CountryCode::class),
        );
    }
}
