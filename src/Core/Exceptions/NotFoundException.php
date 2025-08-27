<?php

namespace Dodopayments\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Not Found Exception';
}
