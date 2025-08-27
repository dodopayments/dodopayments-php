<?php

namespace Dodopayments\Core;

use Dodopayments\Client;
use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkPage;
use Dodopayments\Core\Contracts\BasePage;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\RequestOptions;

/**
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class CursorPagePagination implements BasePage
{
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
        mixed $data,
    ) {
        self::introspect();

        if (!is_array($data)) {
            return;
        }

        self::__unserialize($data);

        if ($this->offsetExists('data')) {
            $acc = Conversion::coerce($convert, value: $this->offsetGet('data'));
            $this->offsetSet('data', $acc);
        }
    }

    /** @return list<TItem> */
    public function getPaginatedItems(): array
    {
        // @phpstan-ignore-next-line
        return $this->offsetGet('data') ?? [];
    }

    /**
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

        $nextRequest = $this->request;

        return [$nextRequest, $this->options];
    }
}
