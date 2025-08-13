<?php

namespace DodoPayments\Errors;

class NotFoundError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'DodoPayments Not Found Error';
}
