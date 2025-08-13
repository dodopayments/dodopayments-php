<?php

namespace DodoPayments\Errors;

class ConflictError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Conflict Error';
}
