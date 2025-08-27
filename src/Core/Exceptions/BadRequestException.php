<?php

namespace Dodopayments\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Bad Request Exception';
}
