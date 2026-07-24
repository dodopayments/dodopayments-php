<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

enum DiscountType: string
{
    case FLAT = 'flat';

    case PERCENTAGE = 'percentage';
}
