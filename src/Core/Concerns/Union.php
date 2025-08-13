<?php

declare(strict_types=1);

namespace DodopaymentsClient\Core\Concerns;

use DodopaymentsClient\Core\Conversion\Contracts\Converter;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;
use DodopaymentsClient\Core\Conversion\UnionOf;

/**
 * @internal
 */
trait Union
{
    private static Converter $converter;

    public static function discriminator(): ?string // @phpstan-ignore-line
    {
        return null;
    }

    /**
     * @return array<string, Converter|ConverterSource|string>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [];
    }

    public static function converter(): Converter
    {
        if (isset(static::$converter)) {
            return static::$converter;
        }

        // @phpstan-ignore-next-line
        return static::$converter = new UnionOf(discriminator: static::discriminator(), variants: static::variants());
    }
}
