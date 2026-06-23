<?php

declare(strict_types=1);

namespace Dodopayments\Products\LocalizedPrices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type LocalizedPriceShape from \Dodopayments\Products\LocalizedPrices\LocalizedPrice
 *
 * @phpstan-type ListLocalizedPricesResponseShape = array{
 *   items: list<LocalizedPrice|LocalizedPriceShape>
 * }
 */
final class ListLocalizedPricesResponse implements BaseModel
{
    /** @use SdkModel<ListLocalizedPricesResponseShape> */
    use SdkModel;

    /** @var list<LocalizedPrice> $items */
    #[Required(list: LocalizedPrice::class)]
    public array $items;

    /**
     * `new ListLocalizedPricesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListLocalizedPricesResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListLocalizedPricesResponse)->withItems(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<LocalizedPrice|LocalizedPriceShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<LocalizedPrice|LocalizedPriceShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
