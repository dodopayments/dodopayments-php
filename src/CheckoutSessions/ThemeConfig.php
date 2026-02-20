<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\CheckoutSessions\ThemeConfig\FontSize;
use Dodopayments\CheckoutSessions\ThemeConfig\FontWeight;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Custom theme configuration with colors for light and dark modes.
 *
 * @phpstan-import-type ThemeModeConfigShape from \Dodopayments\CheckoutSessions\ThemeModeConfig
 *
 * @phpstan-type ThemeConfigShape = array{
 *   dark?: null|ThemeModeConfig|ThemeModeConfigShape,
 *   fontPrimaryURL?: string|null,
 *   fontSecondaryURL?: string|null,
 *   fontSize?: null|FontSize|value-of<FontSize>,
 *   fontWeight?: null|FontWeight|value-of<FontWeight>,
 *   light?: null|ThemeModeConfig|ThemeModeConfigShape,
 *   payButtonText?: string|null,
 *   radius?: string|null,
 * }
 */
final class ThemeConfig implements BaseModel
{
    /** @use SdkModel<ThemeConfigShape> */
    use SdkModel;

    /**
     * Dark mode color configuration.
     */
    #[Optional(nullable: true)]
    public ?ThemeModeConfig $dark;

    /**
     * URL for the primary font. Must be a valid https:// URL.
     */
    #[Optional('font_primary_url', nullable: true)]
    public ?string $fontPrimaryURL;

    /**
     * URL for the secondary font. Must be a valid https:// URL.
     */
    #[Optional('font_secondary_url', nullable: true)]
    public ?string $fontSecondaryURL;

    /**
     * Font size for the checkout UI.
     *
     * @var value-of<FontSize>|null $fontSize
     */
    #[Optional('font_size', enum: FontSize::class, nullable: true)]
    public ?string $fontSize;

    /**
     * Font weight for the checkout UI.
     *
     * @var value-of<FontWeight>|null $fontWeight
     */
    #[Optional('font_weight', enum: FontWeight::class, nullable: true)]
    public ?string $fontWeight;

    /**
     * Light mode color configuration.
     */
    #[Optional(nullable: true)]
    public ?ThemeModeConfig $light;

    /**
     * Custom text for the pay button (e.g., "Complete Purchase", "Subscribe Now"). Max 100 characters.
     */
    #[Optional('pay_button_text', nullable: true)]
    public ?string $payButtonText;

    /**
     * Border radius for UI elements. Must be a number followed by px, rem, or em (e.g., "4px", "0.5rem", "1em").
     */
    #[Optional(nullable: true)]
    public ?string $radius;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ThemeModeConfig|ThemeModeConfigShape|null $dark
     * @param FontSize|value-of<FontSize>|null $fontSize
     * @param FontWeight|value-of<FontWeight>|null $fontWeight
     * @param ThemeModeConfig|ThemeModeConfigShape|null $light
     */
    public static function with(
        ThemeModeConfig|array|null $dark = null,
        ?string $fontPrimaryURL = null,
        ?string $fontSecondaryURL = null,
        FontSize|string|null $fontSize = null,
        FontWeight|string|null $fontWeight = null,
        ThemeModeConfig|array|null $light = null,
        ?string $payButtonText = null,
        ?string $radius = null,
    ): self {
        $self = new self;

        null !== $dark && $self['dark'] = $dark;
        null !== $fontPrimaryURL && $self['fontPrimaryURL'] = $fontPrimaryURL;
        null !== $fontSecondaryURL && $self['fontSecondaryURL'] = $fontSecondaryURL;
        null !== $fontSize && $self['fontSize'] = $fontSize;
        null !== $fontWeight && $self['fontWeight'] = $fontWeight;
        null !== $light && $self['light'] = $light;
        null !== $payButtonText && $self['payButtonText'] = $payButtonText;
        null !== $radius && $self['radius'] = $radius;

        return $self;
    }

    /**
     * Dark mode color configuration.
     *
     * @param ThemeModeConfig|ThemeModeConfigShape|null $dark
     */
    public function withDark(ThemeModeConfig|array|null $dark): self
    {
        $self = clone $this;
        $self['dark'] = $dark;

        return $self;
    }

    /**
     * URL for the primary font. Must be a valid https:// URL.
     */
    public function withFontPrimaryURL(?string $fontPrimaryURL): self
    {
        $self = clone $this;
        $self['fontPrimaryURL'] = $fontPrimaryURL;

        return $self;
    }

    /**
     * URL for the secondary font. Must be a valid https:// URL.
     */
    public function withFontSecondaryURL(?string $fontSecondaryURL): self
    {
        $self = clone $this;
        $self['fontSecondaryURL'] = $fontSecondaryURL;

        return $self;
    }

    /**
     * Font size for the checkout UI.
     *
     * @param FontSize|value-of<FontSize>|null $fontSize
     */
    public function withFontSize(FontSize|string|null $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

        return $self;
    }

    /**
     * Font weight for the checkout UI.
     *
     * @param FontWeight|value-of<FontWeight>|null $fontWeight
     */
    public function withFontWeight(FontWeight|string|null $fontWeight): self
    {
        $self = clone $this;
        $self['fontWeight'] = $fontWeight;

        return $self;
    }

    /**
     * Light mode color configuration.
     *
     * @param ThemeModeConfig|ThemeModeConfigShape|null $light
     */
    public function withLight(ThemeModeConfig|array|null $light): self
    {
        $self = clone $this;
        $self['light'] = $light;

        return $self;
    }

    /**
     * Custom text for the pay button (e.g., "Complete Purchase", "Subscribe Now"). Max 100 characters.
     */
    public function withPayButtonText(?string $payButtonText): self
    {
        $self = clone $this;
        $self['payButtonText'] = $payButtonText;

        return $self;
    }

    /**
     * Border radius for UI elements. Must be a number followed by px, rem, or em (e.g., "4px", "0.5rem", "1em").
     */
    public function withRadius(?string $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
