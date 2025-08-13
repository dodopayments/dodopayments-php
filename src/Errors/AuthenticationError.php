<?php

namespace DodoPayments\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Authentication Error';
}
