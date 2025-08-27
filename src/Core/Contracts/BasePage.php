<?php

declare(strict_types=1);

namespace Dodopayments\Core\Contracts;

use Dodopayments\Client;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\RequestOptions;

/**
 * @template Item
 *
 * @extends \IteratorAggregate<int, static>
 */
interface BasePage extends \IteratorAggregate
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

    public function hasNextPage(): bool;

    /**
     * @return list<Item>
     */
    public function getPaginatedItems(): array;

    /**
     * @return static<Item>
     */
    public function getNextPage(): static;
}
