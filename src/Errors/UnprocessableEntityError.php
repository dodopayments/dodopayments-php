<?php

namespace Dodopayments\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Unprocessable Entity Error';
}
