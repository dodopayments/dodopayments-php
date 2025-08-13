<?php

namespace DodoPayments\Errors;

class BadRequestError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Bad Request Error';
}
