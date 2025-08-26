<?php

namespace Dodopayments\Core\Errors;

class ConflictError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Conflict Error';
}
