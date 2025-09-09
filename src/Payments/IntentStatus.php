<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

enum IntentStatus: string
{
    case SUCCEEDED = 'succeeded';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';

    case PROCESSING = 'processing';

    case REQUIRES_CUSTOMER_ACTION = 'requires_customer_action';

    case REQUIRES_MERCHANT_ACTION = 'requires_merchant_action';

    case REQUIRES_PAYMENT_METHOD = 'requires_payment_method';

    case REQUIRES_CONFIRMATION = 'requires_confirmation';

    case REQUIRES_CAPTURE = 'requires_capture';

    case PARTIALLY_CAPTURED = 'partially_captured';

    case PARTIALLY_CAPTURED_AND_CAPTURABLE = 'partially_captured_and_capturable';
}
