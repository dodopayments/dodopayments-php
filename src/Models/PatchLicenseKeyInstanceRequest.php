<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class PatchLicenseKeyInstanceRequest
{
    #[SerializedName('name')]
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
