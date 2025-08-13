<?php

namespace DodopaymentsClient\Errors;

class RateLimitError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Rate Limit Error';
}
