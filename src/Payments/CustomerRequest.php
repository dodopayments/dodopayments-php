<?php

declare(strict_types=1);

namespace DodoPayments\Payments;

use DodoPayments\Core\Concerns\Union;
use DodoPayments\Core\Conversion\Contracts\Converter;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type customer_request_alias = AttachExistingCustomer|NewCustomer
 */
final class CustomerRequest implements ConverterSource
{
    use Union;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [AttachExistingCustomer::class, NewCustomer::class];
    }
}
