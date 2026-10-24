<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Translations;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Locale;

/**
 * The translation of an entitlement in one locale.
 *
 * @phpstan-type EntitlementTranslationShape = array{
 *   locale: Locale|value-of<Locale>,
 *   updatedAt: \DateTimeInterface,
 *   activationMessage?: string|null,
 *   description?: string|null,
 *   instructions?: string|null,
 *   name?: string|null,
 * }
 */
final class EntitlementTranslation implements BaseModel
{
    /** @use SdkModel<EntitlementTranslationShape> */
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
     * The translated activation message of a `license_key` entitlement.
     */
    #[Optional('activation_message', nullable: true)]
    public ?string $activationMessage;

    /**
     * The translated description. `null` shows that the description has no translation.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * The translated delivery instructions of a `digital_files` entitlement.
     */
    #[Optional(nullable: true)]
    public ?string $instructions;

    /**
     * The translated name. `null` shows that the name has no translation.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new EntitlementTranslation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntitlementTranslation::with(locale: ..., updatedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntitlementTranslation)->withLocale(...)->withUpdatedAt(...)
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
        ?string $activationMessage = null,
        ?string $description = null,
        ?string $instructions = null,
        ?string $name = null,
    ): self {
        $self = new self;

        $self['locale'] = $locale;
        $self['updatedAt'] = $updatedAt;

        null !== $activationMessage && $self['activationMessage'] = $activationMessage;
        null !== $description && $self['description'] = $description;
        null !== $instructions && $self['instructions'] = $instructions;
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
     * The translated activation message of a `license_key` entitlement.
     */
    public function withActivationMessage(?string $activationMessage): self
    {
        $self = clone $this;
        $self['activationMessage'] = $activationMessage;

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
     * The translated delivery instructions of a `digital_files` entitlement.
     */
    public function withInstructions(?string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

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
