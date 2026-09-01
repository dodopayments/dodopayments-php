<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

use Dodopayments\Blocklist\Customers\CreateBlockedCustomerRequest\BlocklistCustomersBlockByCustomerID;
use Dodopayments\Blocklist\Customers\CreateBlockedCustomerRequest\BlocklistCustomersBlockByEmail;
use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type BlocklistCustomersBlockByCustomerIDShape from \Dodopayments\Blocklist\Customers\CreateBlockedCustomerRequest\BlocklistCustomersBlockByCustomerID
 * @phpstan-import-type BlocklistCustomersBlockByEmailShape from \Dodopayments\Blocklist\Customers\CreateBlockedCustomerRequest\BlocklistCustomersBlockByEmail
 *
 * @phpstan-type CreateBlockedCustomerRequestVariants = BlocklistCustomersBlockByCustomerID|BlocklistCustomersBlockByEmail
 * @phpstan-type CreateBlockedCustomerRequestShape = CreateBlockedCustomerRequestVariants|BlocklistCustomersBlockByCustomerIDShape|BlocklistCustomersBlockByEmailShape
 */
final class CreateBlockedCustomerRequest implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            BlocklistCustomersBlockByCustomerID::class,
            BlocklistCustomersBlockByEmail::class,
        ];
    }
}
