<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\MiscContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class MiscService implements MiscContract
{
    /**
     * @api
     */
    public MiscRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MiscRawService($client);
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<value-of<CountryCode>>
     *
     * @throws APIException
     */
    public function listSupportedCountries(
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listSupportedCountries(requestOptions: $requestOptions);

        return $response->parse();
    }
}
