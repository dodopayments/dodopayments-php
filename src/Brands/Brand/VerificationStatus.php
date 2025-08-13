<?php

declare(strict_types=1);

namespace Dodopayments\Brands\Brand;

use Dodopayments\Core\Concerns\Enum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type verification_status_alias = VerificationStatus::*
 */
final class VerificationStatus implements ConverterSource
{
    use Enum;

    public const SUCCESS = 'Success';

    public const FAIL = 'Fail';

    public const REVIEW = 'Review';

    public const HOLD = 'Hold';
}
