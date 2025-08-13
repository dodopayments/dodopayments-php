<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Misc\CountryCode;
use Dodopayments\RequestOptions;

interface MiscContract
{
    /**
     * @return list<CountryCode::*>
     */
    public function listSupportedCountries(
        ?RequestOptions $requestOptions = null
    ): array;
}
