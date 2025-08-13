<?php

declare(strict_types=1);

namespace DodopaymentsClient\Payments\PaymentListParams;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by status.
 *
 * @phpstan-type status_alias = Status::*
 */
final class Status implements ConverterSource
{
    use Enum;

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
