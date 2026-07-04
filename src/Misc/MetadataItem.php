<?php

declare(strict_types=1);

namespace Dodopayments\Misc;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Metadata value can be a string, integer, number, or boolean.
 *
 * @phpstan-type MetadataItemVariants = string|float|bool
 * @phpstan-type MetadataItemShape = MetadataItemVariants
 */
final class MetadataItem implements ConverterSource
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
