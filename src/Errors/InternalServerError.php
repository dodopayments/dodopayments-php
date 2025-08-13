<?php

namespace DodopaymentsClient\Errors;

class InternalServerError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Internal Server Error';
}
