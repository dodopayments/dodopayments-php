<?php

namespace Dodopayments\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Unprocessable Entity Exception';
}
