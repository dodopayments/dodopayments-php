<?php

declare(strict_types=1);

namespace DodoPayments\Core\Concerns;

use DodoPayments\Core\BaseClient;
use DodoPayments\Core\Pagination\PageRequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface Page
{
    public function __construct(
        BaseClient $client,
        PageRequestOptions $options,
        ResponseInterface $response,
        mixed $body,
    );
}
