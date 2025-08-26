<?php

namespace Dodopayments\Core\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Authentication Error';
}
