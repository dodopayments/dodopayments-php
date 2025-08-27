<?php

namespace Dodopayments\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dodopayments Permission Denied Exception';
}
