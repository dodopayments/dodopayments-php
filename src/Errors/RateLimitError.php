<?php

namespace DodoPayments\Errors;

class RateLimitError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Rate Limit Error';
}
