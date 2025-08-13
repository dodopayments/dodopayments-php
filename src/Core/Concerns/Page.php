<?php

declare(strict_types=1);

namespace Dodopayments\Core\Concerns;

use Dodopayments\Core\BaseClient;
use Dodopayments\Core\Pagination\PageRequestOptions;
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
