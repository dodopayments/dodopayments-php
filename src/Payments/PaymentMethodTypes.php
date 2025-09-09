<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

enum PaymentMethodTypes: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';

    case UPI_COLLECT = 'upi_collect';

    case UPI_INTENT = 'upi_intent';

    case APPLE_PAY = 'apple_pay';

    case CASHAPP = 'cashapp';

    case GOOGLE_PAY = 'google_pay';

    case MULTIBANCO = 'multibanco';

    case BANCONTACT_CARD = 'bancontact_card';

    case EPS = 'eps';

    case IDEAL = 'ideal';

    case PRZELEWY24 = 'przelewy24';

    case AFFIRM = 'affirm';

    case KLARNA = 'klarna';

    case SEPA = 'sepa';

    case ACH = 'ach';

    case AMAZON_PAY = 'amazon_pay';

    case AFTERPAY_CLEARPAY = 'afterpay_clearpay';
}
