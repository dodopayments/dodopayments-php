<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\ServiceContracts\InvoicesContract;
use Dodopayments\Services\Invoices\PaymentsService;

final class InvoicesService implements InvoicesContract
{
    /**
     * @@api
     */
    public PaymentsService $payments;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->payments = new PaymentsService($this->client);
    }
}
