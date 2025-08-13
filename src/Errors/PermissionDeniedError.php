<?php

namespace Dodopayments\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Permission Denied Error';
}
