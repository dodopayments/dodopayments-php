<?php

namespace Dodopayments\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Internal Server Exception';
}
