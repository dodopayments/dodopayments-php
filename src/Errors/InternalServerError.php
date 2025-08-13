<?php

namespace Dodopayments\Errors;

class InternalServerError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Internal Server Error';
}
