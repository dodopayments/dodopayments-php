<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization;

use Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization\ThemeConfig\Dark;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization\ThemeConfig\FontSize;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization\ThemeConfig\FontWeight;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization\ThemeConfig\Light;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Optional custom theme configuration with colors for light and dark modes.
 *
 * @phpstan-import-type DarkShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization\ThemeConfig\Dark
 * @phpstan-import-type LightShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization\ThemeConfig\Light
 *
 * @phpstan-type ThemeConfigShape = array{
 *   dark?: null|Dark|DarkShape,
 *   fontSize?: null|FontSize|value-of<FontSize>,
 *   fontWeight?: null|FontWeight|value-of<FontWeight>,
 *   light?: null|Light|LightShape,
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
    public ?Dark $dark;

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
    public ?Light $light;

    /**
     * Custom text for the pay button (e.g., "Complete Purchase", "Subscribe Now").
     */
    #[Optional('pay_button_text', nullable: true)]
    public ?string $payButtonText;

    /**
     * Border radius for UI elements (e.g., "4px", "0.5rem", "8px").
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
     * @param Dark|DarkShape|null $dark
     * @param FontSize|value-of<FontSize>|null $fontSize
     * @param FontWeight|value-of<FontWeight>|null $fontWeight
     * @param Light|LightShape|null $light
     */
    public static function with(
        Dark|array|null $dark = null,
        FontSize|string|null $fontSize = null,
        FontWeight|string|null $fontWeight = null,
        Light|array|null $light = null,
        ?string $payButtonText = null,
        ?string $radius = null,
    ): self {
        $self = new self;

        null !== $dark && $self['dark'] = $dark;
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
     * @param Dark|DarkShape|null $dark
     */
    public function withDark(Dark|array|null $dark): self
    {
        $self = clone $this;
        $self['dark'] = $dark;

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
     * @param Light|LightShape|null $light
     */
    public function withLight(Light|array|null $light): self
    {
        $self = clone $this;
        $self['light'] = $light;

        return $self;
    }

    /**
     * Custom text for the pay button (e.g., "Complete Purchase", "Subscribe Now").
     */
    public function withPayButtonText(?string $payButtonText): self
    {
        $self = clone $this;
        $self['payButtonText'] = $payButtonText;

        return $self;
    }

    /**
     * Border radius for UI elements (e.g., "4px", "0.5rem", "8px").
     */
    public function withRadius(?string $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
