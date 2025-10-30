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
 * @phpstan-type CursorPagePaginationShape = array{
 *   data?: list<mixed>|null, iterator?: string|null, done?: bool|null
 * }
 *
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class CursorPagePagination implements BaseModel, BasePage
{
    /** @use SdkModel<CursorPagePaginationShape> */
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $data */
    #[Api(list: 'mixed', optional: true)]
    public ?array $data;

    #[Api(optional: true)]
    public ?string $iterator;

    #[Api(optional: true)]
    public ?bool $done;

    /**
     * @internal
     *
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string, mixed>,
     *   headers: array<string, string|list<string>|null>,
     *   body: mixed,
     * } $request
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $request,
        private RequestOptions $options,
        ResponseInterface $response,
    ) {
        $this->initialize();

        $data = Util::decodeContent($response);

        if (!is_array($data)) {
            return;
        }

        // @phpstan-ignore-next-line
        self::__unserialize($data);

        if ($this->offsetExists('data')) {
            $acc = Conversion::coerce(
                new ListOf($convert),
                value: $this->offsetGet('data')
            );
            // @phpstan-ignore-next-line
            $this->offsetSet('data', $acc);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line
        return $this->offsetGet('data') ?? [];
    }

    /**
     * @internal
     *
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string, mixed>,
     *     headers: array<string, string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        $next = $this->iterator ?? null;
        if (!$next) {
            return null;
        }

        $nextRequest = array_merge_recursive(
            $this->request,
            ['query' => ['iterator' => $next]]
        );

        // @phpstan-ignore-next-line
        return [$nextRequest, $this->options];
    }
}
