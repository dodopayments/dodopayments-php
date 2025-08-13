<?php

namespace DodoPayments\Errors;

class Error extends \Exception
{
    /** @var string */
    protected const DESC = 'DodoPayments Error';

    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($this::DESC.' '.$message, $code, $previous);
    }
}
