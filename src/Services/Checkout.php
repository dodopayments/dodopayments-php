<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Services;

use Dodopayments\Utils\Serializer;
use Dodopayments\Models;

class Checkout extends BaseService
{
    public function getSupportedCountriesProxy(): array
    {
        $data = $this->sendRequest('get', '/checkout/supported_countries', []);

        return json_decode($data, true);
    }
}
