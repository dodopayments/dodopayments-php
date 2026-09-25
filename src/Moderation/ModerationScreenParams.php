<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Screens text, an image, or both, and returns a verdict: `allow`, `flag` or `deny`. The API is
 * fail-closed: do not generate when you get no verdict.
 *
 * **Pricing.** Dodo Payments charges $0.30 per 1000 billable screens and debits the fee from your
 * balance. A billable screen is a live-mode screen that returns a verdict. Errors and test-mode
 * screens are free.
 *
 * **429.** Honour `Retry-After` and retry. A 429 is a throughput limit, not a verdict.
 *
 * **Test mode** returns mock verdicts and never calls the model. The default verdict is
 * `allow`. Put one of these strings in `text` to select another outcome: `dodo_mock_flag`
 * (`flag`), `dodo_mock_deny` (`deny`), `dodo_mock_overloaded` (429) or `dodo_mock_not_ready`
 * (503).
 *
 * @see Dodopayments\Services\ModerationService::screen()
 *
 * @phpstan-type ModerationScreenParamsShape = array{
 *   image?: string|null, requestID?: string|null, text?: string|null
 * }
 */
final class ModerationScreenParams implements BaseModel
{
    /** @use SdkModel<ModerationScreenParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The image to screen, as base64, with or without a `data:image/...;base64,` prefix. The
     * formats are JPEG, PNG, WebP, GIF and BMP. The limit is 6991530 base64 characters, and the
     * decoded image must be at most 5 MiB.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * Your identifier for this screen, up to 128 characters, with no control characters. The
     * response returns it in `request_id`.
     */
    #[Optional('request_id', nullable: true)]
    public ?string $requestID;

    /**
     * The text to screen, up to 8000 characters.
     */
    #[Optional(nullable: true)]
    public ?string $text;

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
        ?string $image = null,
        ?string $requestID = null,
        ?string $text = null
    ): self {
        $self = new self;

        null !== $image && $self['image'] = $image;
        null !== $requestID && $self['requestID'] = $requestID;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * The image to screen, as base64, with or without a `data:image/...;base64,` prefix. The
     * formats are JPEG, PNG, WebP, GIF and BMP. The limit is 6991530 base64 characters, and the
     * decoded image must be at most 5 MiB.
     */
    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * Your identifier for this screen, up to 128 characters, with no control characters. The
     * response returns it in `request_id`.
     */
    public function withRequestID(?string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * The text to screen, up to 8000 characters.
     */
    public function withText(?string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
