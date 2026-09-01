<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Which customer to block. Untagged, so the caller sends `customer_id` or
 * `email` at the top level, as `CustomerRequest` does on the payment routes.
 * A body that carries both matches the first variant, so `customer_id` wins.
 *
 * @phpstan-import-type BlockByCustomerIDShape from \Dodopayments\Blocklist\Customers\BlockByCustomerID
 * @phpstan-import-type BlockByEmailShape from \Dodopayments\Blocklist\Customers\BlockByEmail
 *
 * @phpstan-type BlockIdentifierVariants = BlockByCustomerID|BlockByEmail
 * @phpstan-type BlockIdentifierShape = BlockIdentifierVariants|BlockByCustomerIDShape|BlockByEmailShape
 */
final class BlockIdentifier implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [BlockByCustomerID::class, BlockByEmail::class];
    }
}
