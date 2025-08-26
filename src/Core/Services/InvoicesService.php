<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\InvoicesContract;
use Dodopayments\Core\Services\Invoices\PaymentsService;

final class InvoicesService implements InvoicesContract
{
    public PaymentsService $payments;

    public function __construct(private Client $client)
    {
        $this->payments = new PaymentsService($this->client);
    }
}
