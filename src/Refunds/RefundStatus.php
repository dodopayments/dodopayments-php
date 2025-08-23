<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class RefundStatus implements ConverterSource
{
    use SdkEnum;

    public const SUCCEEDED = 'succeeded';

    public const FAILED = 'failed';

    public const PENDING = 'pending';

    public const REVIEW = 'review';
}
