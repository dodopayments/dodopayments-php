<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Client;
use Dodopayments\Contracts\InvoicesContract;
use Dodopayments\Invoices\Payments\PaymentsService;

final class InvoicesService implements InvoicesContract
{
    public PaymentsService $payments;

    public function __construct(private Client $client)
    {
        $this->payments = new PaymentsService($this->client);
    }
}
