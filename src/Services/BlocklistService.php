<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\ServiceContracts\BlocklistContract;
use Dodopayments\Services\Blocklist\CustomersService;

final class BlocklistService implements BlocklistContract
{
    /**
     * @api
     */
    public BlocklistRawService $raw;

    /**
     * @api
     */
    public CustomersService $customers;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BlocklistRawService($client);
        $this->customers = new CustomersService($client);
    }
}
