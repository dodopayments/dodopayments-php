<?php

namespace Dodopayments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkPage;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Contracts\BasePage;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\Util;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type DefaultPageNumberPaginationShape = array{items?: list<mixed>|null}
 *
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class DefaultPageNumberPagination implements BaseModel, BasePage
{
    /** @use SdkModel<DefaultPageNumberPaginationShape> */
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $items */
    #[Api(list: 'mixed', optional: true)]
    public ?array $items;

    /**
     * @internal
     *
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string,mixed>,
     *   headers: array<string,string|list<string>|null>,
     *   body: mixed,
     * } $requestInfo
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $requestInfo,
        private RequestOptions $options,
        private ResponseInterface $response,
        private mixed $parsedBody,
    ) {
        $this->initialize();

        if (!is_array($this->parsedBody)) {
            return;
        }

        // @phpstan-ignore-next-line argument.type
        self::__unserialize($this->parsedBody);

        if ($this->offsetGet('items')) {
            $acc = Conversion::coerce(
                new ListOf($convert),
                value: $this->offsetGet('items')
            );
            // @phpstan-ignore-next-line
            $this->offsetSet('items', $acc);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line return.type
        return $this->offsetGet('items') ?? [];
    }

    /**
     * @internal
     *
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string,mixed>,
     *     headers: array<string,string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        /** @var int */
        $curr = Util::dig($this->requestInfo, ['query', 'page_number']) ?? 1;
        if (!count($this->getItems())) {
            return null;
        }

        $nextRequest = array_merge_recursive(
            $this->requestInfo,
            ['query' => $curr + 1]
        );

        // @phpstan-ignore-next-line return.type
        return [$nextRequest, $this->options];
    }
}
