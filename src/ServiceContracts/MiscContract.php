<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\LocaleInfo;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface MiscContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<LocaleInfo>
     *
     * @throws APIException
     */
    public function listLocales(
        RequestOptions|array|null $requestOptions = null
    ): array;

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
    ): array;
}
