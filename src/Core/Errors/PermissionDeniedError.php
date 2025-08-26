<?php

namespace Dodopayments\Core\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Permission Denied Error';
}
