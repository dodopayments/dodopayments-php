<?php

namespace DodopaymentsClient\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Unprocessable Entity Error';
}
