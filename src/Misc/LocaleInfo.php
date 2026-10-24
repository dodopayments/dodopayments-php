<?php

declare(strict_types=1);

namespace Dodopayments\Misc;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * A locale that the checkout and the customer portal can show.
 *
 * @phpstan-type LocaleInfoShape = array{
 *   code: Locale|value-of<Locale>, name: string, nativeName: string
 * }
 */
final class LocaleInfo implements BaseModel
{
    /** @use SdkModel<LocaleInfoShape> */
    use SdkModel;

    /**
     * The code to send in the `locale` parameter.
     *
     * @var value-of<Locale> $code
     */
    #[Required(enum: Locale::class)]
    public string $code;

    /**
     * The English name of the language.
     */
    #[Required]
    public string $name;

    /**
     * The name of the language in that language.
     */
    #[Required('native_name')]
    public string $nativeName;

    /**
     * `new LocaleInfo()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocaleInfo::with(code: ..., name: ..., nativeName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocaleInfo)->withCode(...)->withName(...)->withNativeName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Locale|value-of<Locale> $code
     */
    public static function with(
        Locale|string $code,
        string $name,
        string $nativeName
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['name'] = $name;
        $self['nativeName'] = $nativeName;

        return $self;
    }

    /**
     * The code to send in the `locale` parameter.
     *
     * @param Locale|value-of<Locale> $code
     */
    public function withCode(Locale|string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The English name of the language.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The name of the language in that language.
     */
    public function withNativeName(string $nativeName): self
    {
        $self = clone $this;
        $self['nativeName'] = $nativeName;

        return $self;
    }
}
