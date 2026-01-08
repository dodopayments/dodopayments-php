<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\MiscRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class MiscRawService implements MiscRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<value-of<CountryCode>>>
     *
     * @throws APIException
     */
    public function listSupportedCountries(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'checkout/supported_countries',
            options: $requestOptions,
            convert: new ListOf(CountryCode::class),
        );
    }
}
