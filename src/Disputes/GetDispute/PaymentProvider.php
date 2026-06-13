<?php

declare(strict_types=1);

namespace Dodopayments\Disputes\GetDispute;

/**
 * Which processor handled the underlying payment. `stripe` / `adyen` for
 * BYOP routes (the merchant's own payment connector); `dodo` for
 * everything Dodo processed itself.
 */
enum PaymentProvider: string
{
    case STRIPE = 'stripe';

    case ADYEN = 'adyen';

    case DODO = 'dodo';
}
