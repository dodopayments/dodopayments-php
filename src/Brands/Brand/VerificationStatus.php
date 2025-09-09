<?php

declare(strict_types=1);

namespace Dodopayments\Brands\Brand;

enum VerificationStatus: string
{
    case SUCCESS = 'Success';

    case FAIL = 'Fail';

    case REVIEW = 'Review';

    case HOLD = 'Hold';
}
