<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents\Event;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Metadata value can be a string, integer, number, or boolean.
 *
 * @phpstan-type MetadataVariants = string|float|bool
 * @phpstan-type MetadataShape = MetadataVariants
 */
final class Metadata implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool'];
    }
}
