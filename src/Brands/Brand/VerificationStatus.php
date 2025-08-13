<?php

declare(strict_types=1);

namespace DodoPayments\Brands\Brand;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

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
