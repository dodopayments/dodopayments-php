<?php

namespace DodoPayments\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Unprocessable Entity Error';
}
