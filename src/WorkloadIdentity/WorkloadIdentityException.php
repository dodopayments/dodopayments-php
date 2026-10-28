<?php

declare(strict_types=1);

namespace Dodopayments\WorkloadIdentity;

use Dodopayments\Core\Exceptions\DodopaymentsException;

class WorkloadIdentityException extends DodopaymentsException
{
    /** @var string */
    protected const DESC = 'Dodopayments Workload Identity Exception';
}
