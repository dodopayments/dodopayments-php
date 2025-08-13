<?php

namespace Dodopayments\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Authentication Error';
}
