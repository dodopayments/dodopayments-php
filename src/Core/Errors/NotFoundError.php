<?php

namespace Dodopayments\Core\Errors;

class NotFoundError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'Dodopayments Not Found Error';
}
