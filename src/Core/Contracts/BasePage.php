<?php

declare(strict_types=1);

namespace Dodopayments\Core\Contracts;

use Dodopayments\Client;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\RequestOptions;

/**
 * @internal
 *
 * @template Item
 *
 * @extends \ArrayAccess<string, mixed>
 * @extends \IteratorAggregate<int, static>
 */
interface BasePage extends \ArrayAccess, \JsonSerializable, \Stringable, \IteratorAggregate
{
    /**
     * @internal
     *
     * @param array<string, mixed> $request
     */
    public function __construct(
        Converter|ConverterSource|string $convert,
        Client $client,
        array $request,
        RequestOptions $options,
        mixed $data,
    );

    /**
     * @return static<Item>
     */
    public static function fromArray(mixed $data): self;

    /** @return array<string, mixed> */
    public function toArray(): array;

    public function hasNextPage(): bool;

    /**
     * @return list<Item>
     */
    public function getPaginatedItems(): array;

    /**
     * @return static<Item>
     */
    public function getNextPage(): static;

    /**
     * @return \Generator<Item>
     */
    public function pagingEachItem(): \Generator;
}
