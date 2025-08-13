<?php

declare(strict_types=1);

namespace DodoPayments\Invoices;

use DodoPayments\Client;
use DodoPayments\Contracts\InvoicesContract;
use DodoPayments\Invoices\Payments\PaymentsService;

final class InvoicesService implements InvoicesContract
{
    public PaymentsService $payments;

    public function __construct(private Client $client)
    {
        $this->payments = new PaymentsService($this->client);
    }
}
