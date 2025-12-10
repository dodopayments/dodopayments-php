<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\ServiceContracts\WebhookEventsContract;

final class WebhookEventsService implements WebhookEventsContract
{
    /**
     * @api
     */
    public WebhookEventsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhookEventsRawService($client);
    }
}
