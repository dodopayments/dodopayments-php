<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Misc\CountryCode;
use DodoPayments\RequestOptions;

interface MiscContract
{
    /**
     * @return list<CountryCode::*>
     */
    public function listSupportedCountries(
        ?RequestOptions $requestOptions = null
    ): array;
}
