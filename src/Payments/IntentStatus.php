<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type intent_status_alias = IntentStatus::*
 */
final class IntentStatus implements ConverterSource
{
    use SdkEnum;

    public const SUCCEEDED = 'succeeded';

    public const FAILED = 'failed';

    public const CANCELLED = 'cancelled';

    public const PROCESSING = 'processing';

    public const REQUIRES_CUSTOMER_ACTION = 'requires_customer_action';

    public const REQUIRES_MERCHANT_ACTION = 'requires_merchant_action';

    public const REQUIRES_PAYMENT_METHOD = 'requires_payment_method';

    public const REQUIRES_CONFIRMATION = 'requires_confirmation';

    public const REQUIRES_CAPTURE = 'requires_capture';

    public const PARTIALLY_CAPTURED = 'partially_captured';

    public const PARTIALLY_CAPTURED_AND_CAPTURABLE = 'partially_captured_and_capturable';
}
