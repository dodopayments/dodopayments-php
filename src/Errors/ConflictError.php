<?php

namespace DodopaymentsClient\Errors;

class ConflictError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Conflict Error';
}
