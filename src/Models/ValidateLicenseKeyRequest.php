<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class ValidateLicenseKeyRequest
{
    #[SerializedName('license_key')]
    public string $licenseKey;

    #[SerializedName('license_key_instance_id')]
    public ?string $licenseKeyInstanceId;

    public function __construct(string $licenseKey, ?string $licenseKeyInstanceId = null)
    {
        $this->licenseKey = $licenseKey;
        $this->licenseKeyInstanceId = $licenseKeyInstanceId;
    }
}
