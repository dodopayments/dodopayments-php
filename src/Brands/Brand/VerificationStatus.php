<?php

declare(strict_types=1);

namespace DodopaymentsClient\Brands\Brand;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

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
