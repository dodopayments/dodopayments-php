<?php

namespace Dodopayments\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Rate Limit Exception';
}
