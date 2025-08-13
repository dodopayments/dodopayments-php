<?php

declare(strict_types=1);

namespace DodopaymentsClient\Payments;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type payment_method_types_alias = PaymentMethodTypes::*
 */
final class PaymentMethodTypes implements ConverterSource
{
    use Enum;

    public const CREDIT = 'credit';

    public const DEBIT = 'debit';

    public const UPI_COLLECT = 'upi_collect';

    public const UPI_INTENT = 'upi_intent';

    public const APPLE_PAY = 'apple_pay';

    public const CASHAPP = 'cashapp';

    public const GOOGLE_PAY = 'google_pay';

    public const MULTIBANCO = 'multibanco';

    public const BANCONTACT_CARD = 'bancontact_card';

    public const EPS = 'eps';

    public const IDEAL = 'ideal';

    public const PRZELEWY24 = 'przelewy24';

    public const AFFIRM = 'affirm';

    public const KLARNA = 'klarna';

    public const SEPA = 'sepa';

    public const ACH = 'ach';

    public const AMAZON_PAY = 'amazon_pay';

    public const AFTERPAY_CLEARPAY = 'afterpay_clearpay';
}
