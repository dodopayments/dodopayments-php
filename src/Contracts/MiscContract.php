<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Misc\CountryCode;
use DodopaymentsClient\RequestOptions;

interface MiscContract
{
    /**
     * @return list<CountryCode::*>
     */
    public function listSupportedCountries(
        ?RequestOptions $requestOptions = null
    ): array;
}
