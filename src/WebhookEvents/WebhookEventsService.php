<?php

declare(strict_types=1);

namespace DodopaymentsClient\WebhookEvents;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\WebhookEventsContract;

final class WebhookEventsService implements WebhookEventsContract
{
  @phpstan-ignore-next-line
  /** @param Client $client */
  function __construct(protected Client $client){}
}