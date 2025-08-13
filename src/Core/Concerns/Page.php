<?php

declare(strict_types=1);

namespace DodopaymentsClient\Core\Concerns;

use DodopaymentsClient\Core\BaseClient;
use DodopaymentsClient\Core\Pagination\PageRequestOptions;
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
