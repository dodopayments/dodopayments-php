<?php

namespace Dodopayments\Core\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Unprocessable Entity Error';
}
