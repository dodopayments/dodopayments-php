<?php

namespace DodoPayments\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Permission Denied Error';
}
