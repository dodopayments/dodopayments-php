<?php

namespace DodoPayments\Errors;

class InternalServerError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Internal Server Error';
}
