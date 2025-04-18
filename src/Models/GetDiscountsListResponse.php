<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class GetDiscountsListResponse
{
    /**
     * @var DiscountResponse[]
     * Array of active (non-deleted) discounts for the current page.
     */
    #[SerializedName('items')]
    public array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
