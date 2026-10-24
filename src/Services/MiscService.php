<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\LocaleInfo;
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
     * Lists the locales that a translation can have.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<LocaleInfo>
     *
     * @throws APIException
     */
    public function listLocales(
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listLocales(requestOptions: $requestOptions);

        return $response->parse();
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
