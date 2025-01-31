<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class ListLicenseKeysResponse
{
    /**
     * @var LicenseKeyResponse[]
     */
    #[SerializedName('items')]
    public array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
