<?php

namespace Dodopayments\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Authentication Exception';
}
