<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\ThemeConfig;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Dark mode color configuration.
 *
 * @phpstan-type DarkShape = array{
 *   bgPrimary?: string|null,
 *   bgSecondary?: string|null,
 *   borderPrimary?: string|null,
 *   borderSecondary?: string|null,
 *   buttonPrimary?: string|null,
 *   buttonPrimaryHover?: string|null,
 *   buttonSecondary?: string|null,
 *   buttonSecondaryHover?: string|null,
 *   buttonTextPrimary?: string|null,
 *   buttonTextSecondary?: string|null,
 *   inputFocusBorder?: string|null,
 *   textError?: string|null,
 *   textPlaceholder?: string|null,
 *   textPrimary?: string|null,
 *   textSecondary?: string|null,
 *   textSuccess?: string|null,
 * }
 */
final class Dark implements BaseModel
{
    /** @use SdkModel<DarkShape> */
    use SdkModel;

    /**
     * Background primary color.
     *
     * Examples: `"#ffffff"`, `"rgb(255, 255, 255)"`, `"white"`
     */
    #[Optional('bg_primary', nullable: true)]
    public ?string $bgPrimary;

    /**
     * Background secondary color.
     */
    #[Optional('bg_secondary', nullable: true)]
    public ?string $bgSecondary;

    /**
     * Border primary color.
     */
    #[Optional('border_primary', nullable: true)]
    public ?string $borderPrimary;

    /**
     * Border secondary color.
     */
    #[Optional('border_secondary', nullable: true)]
    public ?string $borderSecondary;

    /**
     * Primary button background color.
     */
    #[Optional('button_primary', nullable: true)]
    public ?string $buttonPrimary;

    /**
     * Primary button hover color.
     */
    #[Optional('button_primary_hover', nullable: true)]
    public ?string $buttonPrimaryHover;

    /**
     * Secondary button background color.
     */
    #[Optional('button_secondary', nullable: true)]
    public ?string $buttonSecondary;

    /**
     * Secondary button hover color.
     */
    #[Optional('button_secondary_hover', nullable: true)]
    public ?string $buttonSecondaryHover;

    /**
     * Primary button text color.
     */
    #[Optional('button_text_primary', nullable: true)]
    public ?string $buttonTextPrimary;

    /**
     * Secondary button text color.
     */
    #[Optional('button_text_secondary', nullable: true)]
    public ?string $buttonTextSecondary;

    /**
     * Input focus border color.
     */
    #[Optional('input_focus_border', nullable: true)]
    public ?string $inputFocusBorder;

    /**
     * Text error color.
     */
    #[Optional('text_error', nullable: true)]
    public ?string $textError;

    /**
     * Text placeholder color.
     */
    #[Optional('text_placeholder', nullable: true)]
    public ?string $textPlaceholder;

    /**
     * Text primary color.
     */
    #[Optional('text_primary', nullable: true)]
    public ?string $textPrimary;

    /**
     * Text secondary color.
     */
    #[Optional('text_secondary', nullable: true)]
    public ?string $textSecondary;

    /**
     * Text success color.
     */
    #[Optional('text_success', nullable: true)]
    public ?string $textSuccess;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $bgPrimary = null,
        ?string $bgSecondary = null,
        ?string $borderPrimary = null,
        ?string $borderSecondary = null,
        ?string $buttonPrimary = null,
        ?string $buttonPrimaryHover = null,
        ?string $buttonSecondary = null,
        ?string $buttonSecondaryHover = null,
        ?string $buttonTextPrimary = null,
        ?string $buttonTextSecondary = null,
        ?string $inputFocusBorder = null,
        ?string $textError = null,
        ?string $textPlaceholder = null,
        ?string $textPrimary = null,
        ?string $textSecondary = null,
        ?string $textSuccess = null,
    ): self {
        $self = new self;

        null !== $bgPrimary && $self['bgPrimary'] = $bgPrimary;
        null !== $bgSecondary && $self['bgSecondary'] = $bgSecondary;
        null !== $borderPrimary && $self['borderPrimary'] = $borderPrimary;
        null !== $borderSecondary && $self['borderSecondary'] = $borderSecondary;
        null !== $buttonPrimary && $self['buttonPrimary'] = $buttonPrimary;
        null !== $buttonPrimaryHover && $self['buttonPrimaryHover'] = $buttonPrimaryHover;
        null !== $buttonSecondary && $self['buttonSecondary'] = $buttonSecondary;
        null !== $buttonSecondaryHover && $self['buttonSecondaryHover'] = $buttonSecondaryHover;
        null !== $buttonTextPrimary && $self['buttonTextPrimary'] = $buttonTextPrimary;
        null !== $buttonTextSecondary && $self['buttonTextSecondary'] = $buttonTextSecondary;
        null !== $inputFocusBorder && $self['inputFocusBorder'] = $inputFocusBorder;
        null !== $textError && $self['textError'] = $textError;
        null !== $textPlaceholder && $self['textPlaceholder'] = $textPlaceholder;
        null !== $textPrimary && $self['textPrimary'] = $textPrimary;
        null !== $textSecondary && $self['textSecondary'] = $textSecondary;
        null !== $textSuccess && $self['textSuccess'] = $textSuccess;

        return $self;
    }

    /**
     * Background primary color.
     *
     * Examples: `"#ffffff"`, `"rgb(255, 255, 255)"`, `"white"`
     */
    public function withBgPrimary(?string $bgPrimary): self
    {
        $self = clone $this;
        $self['bgPrimary'] = $bgPrimary;

        return $self;
    }

    /**
     * Background secondary color.
     */
    public function withBgSecondary(?string $bgSecondary): self
    {
        $self = clone $this;
        $self['bgSecondary'] = $bgSecondary;

        return $self;
    }

    /**
     * Border primary color.
     */
    public function withBorderPrimary(?string $borderPrimary): self
    {
        $self = clone $this;
        $self['borderPrimary'] = $borderPrimary;

        return $self;
    }

    /**
     * Border secondary color.
     */
    public function withBorderSecondary(?string $borderSecondary): self
    {
        $self = clone $this;
        $self['borderSecondary'] = $borderSecondary;

        return $self;
    }

    /**
     * Primary button background color.
     */
    public function withButtonPrimary(?string $buttonPrimary): self
    {
        $self = clone $this;
        $self['buttonPrimary'] = $buttonPrimary;

        return $self;
    }

    /**
     * Primary button hover color.
     */
    public function withButtonPrimaryHover(?string $buttonPrimaryHover): self
    {
        $self = clone $this;
        $self['buttonPrimaryHover'] = $buttonPrimaryHover;

        return $self;
    }

    /**
     * Secondary button background color.
     */
    public function withButtonSecondary(?string $buttonSecondary): self
    {
        $self = clone $this;
        $self['buttonSecondary'] = $buttonSecondary;

        return $self;
    }

    /**
     * Secondary button hover color.
     */
    public function withButtonSecondaryHover(
        ?string $buttonSecondaryHover
    ): self {
        $self = clone $this;
        $self['buttonSecondaryHover'] = $buttonSecondaryHover;

        return $self;
    }

    /**
     * Primary button text color.
     */
    public function withButtonTextPrimary(?string $buttonTextPrimary): self
    {
        $self = clone $this;
        $self['buttonTextPrimary'] = $buttonTextPrimary;

        return $self;
    }

    /**
     * Secondary button text color.
     */
    public function withButtonTextSecondary(?string $buttonTextSecondary): self
    {
        $self = clone $this;
        $self['buttonTextSecondary'] = $buttonTextSecondary;

        return $self;
    }

    /**
     * Input focus border color.
     */
    public function withInputFocusBorder(?string $inputFocusBorder): self
    {
        $self = clone $this;
        $self['inputFocusBorder'] = $inputFocusBorder;

        return $self;
    }

    /**
     * Text error color.
     */
    public function withTextError(?string $textError): self
    {
        $self = clone $this;
        $self['textError'] = $textError;

        return $self;
    }

    /**
     * Text placeholder color.
     */
    public function withTextPlaceholder(?string $textPlaceholder): self
    {
        $self = clone $this;
        $self['textPlaceholder'] = $textPlaceholder;

        return $self;
    }

    /**
     * Text primary color.
     */
    public function withTextPrimary(?string $textPrimary): self
    {
        $self = clone $this;
        $self['textPrimary'] = $textPrimary;

        return $self;
    }

    /**
     * Text secondary color.
     */
    public function withTextSecondary(?string $textSecondary): self
    {
        $self = clone $this;
        $self['textSecondary'] = $textSecondary;

        return $self;
    }

    /**
     * Text success color.
     */
    public function withTextSuccess(?string $textSuccess): self
    {
        $self = clone $this;
        $self['textSuccess'] = $textSuccess;

        return $self;
    }
}
