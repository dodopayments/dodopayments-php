<?php

namespace DodopaymentsClient\Errors;

class BadRequestError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Bad Request Error';
}
