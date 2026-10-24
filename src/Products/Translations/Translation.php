<?php

declare(strict_types=1);

namespace Dodopayments\Products\Translations;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Locale;

/**
 * The translation of a product, an add-on, a product collection or a meter in one locale.
 *
 * @phpstan-type TranslationShape = array{
 *   locale: Locale|value-of<Locale>,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   name?: string|null,
 * }
 */
final class Translation implements BaseModel
{
    /** @use SdkModel<TranslationShape> */
    use SdkModel;

    /**
     * The locale of the translation.
     *
     * @var value-of<Locale> $locale
     */
    #[Required(enum: Locale::class)]
    public string $locale;

    /**
     * The time of the last change.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * The translated description. `null` shows that the description has no translation.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * The translated name. `null` shows that the name has no translation.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new Translation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Translation::with(locale: ..., updatedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Translation)->withLocale(...)->withUpdatedAt(...)
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
     * @param Locale|value-of<Locale> $locale
     */
    public static function with(
        Locale|string $locale,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        ?string $name = null,
    ): self {
        $self = new self;

        $self['locale'] = $locale;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The locale of the translation.
     *
     * @param Locale|value-of<Locale> $locale
     */
    public function withLocale(Locale|string $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }

    /**
     * The time of the last change.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The translated description. `null` shows that the description has no translation.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The translated name. `null` shows that the name has no translation.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
