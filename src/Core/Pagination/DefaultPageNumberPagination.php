<?php

namespace DodoPayments\Core\Pagination;

use DodoPayments\Core\BaseClient;
use Psr\Http\Message\ResponseInterface;

/**
 * @template TItem
 *
 * @extends AbstractPage<TItem>
 */
final class DefaultPageNumberPagination extends AbstractPage
{
    /** @var list<TItem> */
    public array $items;

    /** @param array{items?: list<TItem>} $body */
    public function __construct(
        protected BaseClient $client,
        protected PageRequestOptions $options,
        protected ResponseInterface $response,
        protected mixed $body,
    ) {
        $this->items = $body['items'] ?? [];
    }

    public function nextPageRequestOptions(): PageRequestOptions
    {
        $currentPage = $this->options->getQueryAsInt('page_number') ?? 1;

        return $this->options->withQuery('page_number', $currentPage + 1);
    }

    /** @return list<TItem> */
    public function getPaginatedItems(): array
    {
        return $this->items;
    }
}
