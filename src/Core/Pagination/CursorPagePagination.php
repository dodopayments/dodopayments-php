<?php

namespace DodoPayments\Core\Pagination;

use DodoPayments\Core\BaseClient;
use Psr\Http\Message\ResponseInterface;

/**
 * @template TItem
 *
 * @extends AbstractPage<TItem>
 */
final class CursorPagePagination extends AbstractPage
{
    /** @var list<TItem> */
    public array $data;

    public ?string $iterator;

    public ?bool $done;

    /** @param array{data?: list<TItem>, iterator?: string, done?: bool} $body */
    public function __construct(
        protected BaseClient $client,
        protected PageRequestOptions $options,
        protected ResponseInterface $response,
        protected mixed $body,
    ) {
        $this->data = $body['data'] ?? [];
        $this->iterator = $body['iterator'] ?? '';
        $this->done = $body['done'] ?? false;
    }

    public function nextPageRequestOptions(): ?PageRequestOptions
    {
        $next = $this->iterator ?? null;
        if (!$next) {
            return null;
        }

        return $this->options->withQuery('iterator', $next);
    }

    /** @return list<TItem> */
    public function getPaginatedItems(): array
    {
        return $this->data;
    }
}
