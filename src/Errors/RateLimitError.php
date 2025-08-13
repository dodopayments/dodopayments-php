<?php

namespace Dodopayments\Errors;

class RateLimitError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Rate Limit Error';
}
