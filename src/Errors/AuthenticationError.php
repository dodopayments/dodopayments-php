<?php

namespace DodopaymentsClient\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Authentication Error';
}
