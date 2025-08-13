<?php

namespace DodopaymentsClient\Errors;

class NotFoundError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodopaymentsClient Not Found Error';
}
