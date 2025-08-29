<?php

declare(strict_types=1);

namespace Dodopayments\Core\ServiceContracts;

use Dodopayments\Misc\CountryCode;
use Dodopayments\RequestOptions;

interface MiscContract
{
    /**
     * @api
     *
     * @return list<CountryCode::*>
     */
    public function listSupportedCountries(
        ?RequestOptions $requestOptions = null
    ): array;
}
