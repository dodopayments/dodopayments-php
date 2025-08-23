<?php

declare(strict_types=1);

namespace Dodopayments\Brands\Brand;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class VerificationStatus implements ConverterSource
{
    use SdkEnum;

    public const SUCCESS = 'Success';

    public const FAIL = 'Fail';

    public const REVIEW = 'Review';

    public const HOLD = 'Hold';
}
