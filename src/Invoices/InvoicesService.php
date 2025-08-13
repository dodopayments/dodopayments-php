<?php

declare(strict_types=1);

namespace DodopaymentsClient\Invoices;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\InvoicesContract;
use DodopaymentsClient\Invoices\Payments\PaymentsService;

final class InvoicesService implements InvoicesContract
{
    public PaymentsService $payments;

    public function __construct(private Client $client)
    {
        $this->payments = new PaymentsService($this->client);
    }
}
