<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type AttachExistingCustomerShape from \Dodopayments\Payments\AttachExistingCustomer
 * @phpstan-import-type NewCustomerShape from \Dodopayments\Payments\NewCustomer
 *
 * @phpstan-type CustomerRequestShape = AttachExistingCustomerShape|NewCustomerShape
 */
final class CustomerRequest implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [AttachExistingCustomer::class, NewCustomer::class];
    }
}
