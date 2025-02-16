# Licenses

A list of all methods in the `Licenses` service. Click on the method name to view detailed information about that method.

| Methods | Description |
| :------ | :---------- |
|[activate_license_key](#activate_license_key)|  |
|[deactivate_license_key](#deactivate_license_key)|  |
|[validate_license_key](#validate_license_key)|  |

## activate_license_key


- HTTP Method: `POST`
- Endpoint: `/licenses/activate`

**Parameters**

| Name    | Type| Required | Description |
| :-------- | :----------| :----------| :----------|
| input | Models\ActivateLicenseKeyRequest | ✅ |  |

**Return Type**

`Models\LicenseKeyInstanceResponse`

**Example Usage Code Snippet**
```php
<?php

use Dodopayments\Client;
use Dodopayments\Models\ActivateLicenseKeyRequest;

$sdk = new Client(accessToken: 'YOUR_TOKEN');


$input = new Models\ActivateLicenseKeyRequest(
  licenseKey: "license_key",
  name: "name"
);

$response = $sdk->licenses->activateLicenseKey(
  input: $input
);

print_r($response);
```

## deactivate_license_key


- HTTP Method: `POST`
- Endpoint: `/licenses/deactivate`

**Parameters**

| Name    | Type| Required | Description |
| :-------- | :----------| :----------| :----------|
| input | Models\DeactivateLicenseKeyRequest | ✅ |  |

**Return Type**

`mixed`

**Example Usage Code Snippet**
```php
<?php

use Dodopayments\Client;
use Dodopayments\Models\DeactivateLicenseKeyRequest;

$sdk = new Client(accessToken: 'YOUR_TOKEN');


$input = new Models\DeactivateLicenseKeyRequest(
  licenseKey: "license_key",
  licenseKeyInstanceId: "license_key_instance_id"
);

$response = $sdk->licenses->deactivateLicenseKey(
  input: $input
);

print_r($response);
```

## validate_license_key


- HTTP Method: `POST`
- Endpoint: `/licenses/validate`

**Parameters**

| Name    | Type| Required | Description |
| :-------- | :----------| :----------| :----------|
| input | Models\ValidateLicenseKeyRequest | ✅ |  |

**Return Type**

`Models\ValidateLicenseKeyResponse`

**Example Usage Code Snippet**
```php
<?php

use Dodopayments\Client;
use Dodopayments\Models\ValidateLicenseKeyRequest;

$sdk = new Client(accessToken: 'YOUR_TOKEN');


$input = new Models\ValidateLicenseKeyRequest(
  licenseKey: "2b1f8e2d-c41e-4e8f-b2d3-d9fd61c38f43",
  licenseKeyInstanceId: "lki_123"
);

$response = $sdk->licenses->validateLicenseKey(
  input: $input
);

print_r($response);
```




<!-- This file was generated by liblab | https://liblab.com/ -->