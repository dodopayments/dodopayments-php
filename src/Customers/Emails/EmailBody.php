<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Emails;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type EmailBodyShape = array{
 *   merchantAuthored: bool,
 *   failureCode?: null|EmailFailureCode|value-of<EmailFailureCode>,
 *   failureReason?: string|null,
 *   html?: string|null,
 *   text?: string|null,
 * }
 */
final class EmailBody implements BaseModel
{
    /** @use SdkModel<EmailBodyShape> */
    use SdkModel;

    /**
     * Whether the merchant wrote this content. It is true for the recovery
     * and dunning emails, which the merchant writes.
     *
     * The content is email HTML. Render it in a sandbox, whatever this value
     * is.
     */
    #[Required('merchant_authored')]
    public bool $merchantAuthored;

    /**
     * Why the email did not arrive. It is null unless the email failed.
     *
     * @var value-of<EmailFailureCode>|null $failureCode
     */
    #[Optional('failure_code', enum: EmailFailureCode::class, nullable: true)]
    public ?string $failureCode;

    /**
     * A sentence that explains `failure_code`. It is null unless the email
     * failed.
     */
    #[Optional('failure_reason', nullable: true)]
    public ?string $failureReason;

    /**
     * The stored HTML. It is null on a text-only email.
     */
    #[Optional(nullable: true)]
    public ?string $html;

    /**
     * The stored plain text.
     */
    #[Optional(nullable: true)]
    public ?string $text;

    /**
     * `new EmailBody()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EmailBody::with(merchantAuthored: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EmailBody)->withMerchantAuthored(...)
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
     * @param EmailFailureCode|value-of<EmailFailureCode>|null $failureCode
     */
    public static function with(
        bool $merchantAuthored,
        EmailFailureCode|string|null $failureCode = null,
        ?string $failureReason = null,
        ?string $html = null,
        ?string $text = null,
    ): self {
        $self = new self;

        $self['merchantAuthored'] = $merchantAuthored;

        null !== $failureCode && $self['failureCode'] = $failureCode;
        null !== $failureReason && $self['failureReason'] = $failureReason;
        null !== $html && $self['html'] = $html;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * Whether the merchant wrote this content. It is true for the recovery
     * and dunning emails, which the merchant writes.
     *
     * The content is email HTML. Render it in a sandbox, whatever this value
     * is.
     */
    public function withMerchantAuthored(bool $merchantAuthored): self
    {
        $self = clone $this;
        $self['merchantAuthored'] = $merchantAuthored;

        return $self;
    }

    /**
     * Why the email did not arrive. It is null unless the email failed.
     *
     * @param EmailFailureCode|value-of<EmailFailureCode>|null $failureCode
     */
    public function withFailureCode(
        EmailFailureCode|string|null $failureCode
    ): self {
        $self = clone $this;
        $self['failureCode'] = $failureCode;

        return $self;
    }

    /**
     * A sentence that explains `failure_code`. It is null unless the email
     * failed.
     */
    public function withFailureReason(?string $failureReason): self
    {
        $self = clone $this;
        $self['failureReason'] = $failureReason;

        return $self;
    }

    /**
     * The stored HTML. It is null on a text-only email.
     */
    public function withHTML(?string $html): self
    {
        $self = clone $this;
        $self['html'] = $html;

        return $self;
    }

    /**
     * The stored plain text.
     */
    public function withText(?string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
