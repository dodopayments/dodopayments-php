<?php

namespace Dodopayments\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Conflict Exception';
}
