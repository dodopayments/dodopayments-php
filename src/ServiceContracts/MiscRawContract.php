<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
use Dodopayments\RequestOptions;

interface MiscRawContract
{
    /**
     * @api
     *
     * @return BaseResponse<list<value-of<CountryCode>>>
     *
     * @throws APIException
     */
    public function listSupportedCountries(
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
