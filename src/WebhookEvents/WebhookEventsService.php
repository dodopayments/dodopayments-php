<?php

declare(strict_types=1);

namespace DodoPayments\WebhookEvents;

use DodoPayments\Client;
use DodoPayments\Contracts\WebhookEventsContract;

final class WebhookEventsService implements WebhookEventsContract
{
  @phpstan-ignore-next-line
  /** @param Client $client */
  function __construct(protected Client $client){}
}