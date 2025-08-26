<?php

namespace Dodopayments\Core\Errors;

class BadRequestError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Bad Request Error';
}
