<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
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
     * @return list<value-of<CountryCode>>
     *
     * @throws APIException
     */
    public function listSupportedCountries(
        RequestOptions|array|null $requestOptions = null
    ): array;
}
