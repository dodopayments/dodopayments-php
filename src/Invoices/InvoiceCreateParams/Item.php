<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceCreateParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\InvoiceCreateParams\Item\CustomItem;
use Dodopayments\Invoices\InvoiceCreateParams\Item\ProductItem;

/**
 * A line that exists only on this invoice.
 *
 * @phpstan-import-type CustomItemShape from \Dodopayments\Invoices\InvoiceCreateParams\Item\CustomItem
 * @phpstan-import-type ProductItemShape from \Dodopayments\Invoices\InvoiceCreateParams\Item\ProductItem
 *
 * @phpstan-type ItemVariants = CustomItem|ProductItem
 * @phpstan-type ItemShape = ItemVariants|CustomItemShape|ProductItemShape
 */
final class Item implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [CustomItem::class, ProductItem::class];
    }
}
