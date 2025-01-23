<?php

// This file was generated by liblab | https://liblab.com/

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Dodopayments\Models;

use Dodopayments\Client;

$sdk = new Client(accessToken: 'YOUR_TOKEN');

$response = $sdk->checkout->getSupportedCountriesProxy();

print_r($response);
