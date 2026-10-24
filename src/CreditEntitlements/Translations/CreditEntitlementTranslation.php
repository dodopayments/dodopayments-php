<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Translations;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Locale;

/**
 * The translation of a credit entitlement in one locale.
 *
 * @phpstan-type CreditEntitlementTranslationShape = array{
 *   locale: Locale|value-of<Locale>,
 *   updatedAt: \DateTimeInterface,
 *   name?: string|null,
 *   unit?: string|null,
 * }
 */
final class CreditEntitlementTranslation implements BaseModel
{
    /** @use SdkModel<CreditEntitlementTranslationShape> */
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
     * The translated name. `null` shows that the name has no translation.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * The translated unit. `null` shows that the unit has no translation.
     */
    #[Optional(nullable: true)]
    public ?string $unit;

    /**
     * `new CreditEntitlementTranslation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlementTranslation::with(locale: ..., updatedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlementTranslation)->withLocale(...)->withUpdatedAt(...)
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
        ?string $name = null,
        ?string $unit = null,
    ): self {
        $self = new self;

        $self['locale'] = $locale;
        $self['updatedAt'] = $updatedAt;

        null !== $name && $self['name'] = $name;
        null !== $unit && $self['unit'] = $unit;

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
     * The translated name. `null` shows that the name has no translation.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The translated unit. `null` shows that the unit has no translation.
     */
    public function withUnit(?string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }
}
