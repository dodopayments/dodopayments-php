<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type customer_request_alias = AttachExistingCustomer|NewCustomer
 */
final class CustomerRequest implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [AttachExistingCustomer::class, NewCustomer::class];
    }
}
