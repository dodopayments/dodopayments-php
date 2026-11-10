<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceUpdateParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\InvoiceUpdateParams\Item\CustomItem;
use Dodopayments\Invoices\InvoiceUpdateParams\Item\ProductItem;

/**
 * A line that exists only on this invoice.
 *
 * @phpstan-import-type CustomItemShape from \Dodopayments\Invoices\InvoiceUpdateParams\Item\CustomItem
 * @phpstan-import-type ProductItemShape from \Dodopayments\Invoices\InvoiceUpdateParams\Item\ProductItem
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
