<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item;

/**
 * PaymentMethod enum from hyperswitch.
 *
 * https://github.com/juspay/hyperswitch/blob/ecd05d53c99ae701ac94893ec632a3988afe3238/crates/common_enums/src/enums.rs#L2097
 */
enum PaymentMethod: string
{
    case CARD = 'card';

    case CARD_REDIRECT = 'card_redirect';

    case PAY_LATER = 'pay_later';

    case WALLET = 'wallet';

    case BANK_REDIRECT = 'bank_redirect';

    case BANK_TRANSFER = 'bank_transfer';

    case CRYPTO = 'crypto';

    case BANK_DEBIT = 'bank_debit';

    case REWARD = 'reward';

    case REAL_TIME_PAYMENT = 'real_time_payment';

    case UPI = 'upi';

    case VOUCHER = 'voucher';

    case GIFT_CARD = 'gift_card';

    case OPEN_BANKING = 'open_banking';

    case MOBILE_PAYMENT = 'mobile_payment';
}
