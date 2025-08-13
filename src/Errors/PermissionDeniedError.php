<?php

namespace DodopaymentsClient\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Permission Denied Error';
}
