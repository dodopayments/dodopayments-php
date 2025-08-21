<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\WebhookEventsContract;

final class WebhookEventsService implements WebhookEventsContract
{
  @phpstan-ignore-next-line
  /** @param Client $client */
  function __construct(protected Client $client){}
}