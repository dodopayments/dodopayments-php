<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Emails;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type EmailPoliciesShape from \Dodopayments\Customers\Emails\EmailPolicies
 *
 * @phpstan-type EmailLogItemShape = array{
 *   category: string,
 *   createdAt: \DateTimeInterface,
 *   emailLogID: string,
 *   emailType: string,
 *   hasPreview: bool,
 *   policies: EmailPolicies|EmailPoliciesShape,
 *   status: EmailLogStatus|value-of<EmailLogStatus>,
 *   failureCode?: null|EmailFailureCode|value-of<EmailFailureCode>,
 *   failureReason?: string|null,
 *   from?: string|null,
 *   intendedRecipient?: string|null,
 *   recipient?: string|null,
 *   subject?: string|null,
 * }
 */
final class EmailLogItem implements BaseModel
{
    /** @use SdkModel<EmailLogItemShape> */
    use SdkModel;

    /**
     * The group this email belongs to: payments, refunds, subscriptions,
     * dunning_recovery, entitlements or auth.
     */
    #[Required]
    public string $category;

    /**
     * When this email was sent.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Identifies this email. Use it to read the body or to send it again.
     */
    #[Required('email_log_id')]
    public string $emailLogID;

    /**
     * What kind of email this is, for example `payment_successful`.
     */
    #[Required('email_type')]
    public string $emailType;

    /**
     * Whether this email has content to show. The content endpoint can still
     * refuse, because the content is removed after 180 days.
     */
    #[Required('has_preview')]
    public bool $hasPreview;

    /**
     * What you may do with this email.
     */
    #[Required]
    public EmailPolicies $policies;

    /**
     * Where the email got to: sent, delivered, failed, complained or blocked.
     *
     * @var value-of<EmailLogStatus> $status
     */
    #[Required(enum: EmailLogStatus::class)]
    public string $status;

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
     * The address the email was sent from.
     */
    #[Optional(nullable: true)]
    public ?string $from;

    /**
     * What the merchant typed, when test mode redirected the send to the
     * business owner.
     */
    #[Optional('intended_recipient', nullable: true)]
    public ?string $intendedRecipient;

    /**
     * The address the email reached.
     */
    #[Optional(nullable: true)]
    public ?string $recipient;

    /**
     * The subject line as it was sent. Empty until the provider replicates.
     */
    #[Optional(nullable: true)]
    public ?string $subject;

    /**
     * `new EmailLogItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EmailLogItem::with(
     *   category: ...,
     *   createdAt: ...,
     *   emailLogID: ...,
     *   emailType: ...,
     *   hasPreview: ...,
     *   policies: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EmailLogItem)
     *   ->withCategory(...)
     *   ->withCreatedAt(...)
     *   ->withEmailLogID(...)
     *   ->withEmailType(...)
     *   ->withHasPreview(...)
     *   ->withPolicies(...)
     *   ->withStatus(...)
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
     * @param EmailPolicies|EmailPoliciesShape $policies
     * @param EmailLogStatus|value-of<EmailLogStatus> $status
     * @param EmailFailureCode|value-of<EmailFailureCode>|null $failureCode
     */
    public static function with(
        string $category,
        \DateTimeInterface $createdAt,
        string $emailLogID,
        string $emailType,
        bool $hasPreview,
        EmailPolicies|array $policies,
        EmailLogStatus|string $status,
        EmailFailureCode|string|null $failureCode = null,
        ?string $failureReason = null,
        ?string $from = null,
        ?string $intendedRecipient = null,
        ?string $recipient = null,
        ?string $subject = null,
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['emailLogID'] = $emailLogID;
        $self['emailType'] = $emailType;
        $self['hasPreview'] = $hasPreview;
        $self['policies'] = $policies;
        $self['status'] = $status;

        null !== $failureCode && $self['failureCode'] = $failureCode;
        null !== $failureReason && $self['failureReason'] = $failureReason;
        null !== $from && $self['from'] = $from;
        null !== $intendedRecipient && $self['intendedRecipient'] = $intendedRecipient;
        null !== $recipient && $self['recipient'] = $recipient;
        null !== $subject && $self['subject'] = $subject;

        return $self;
    }

    /**
     * The group this email belongs to: payments, refunds, subscriptions,
     * dunning_recovery, entitlements or auth.
     */
    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * When this email was sent.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Identifies this email. Use it to read the body or to send it again.
     */
    public function withEmailLogID(string $emailLogID): self
    {
        $self = clone $this;
        $self['emailLogID'] = $emailLogID;

        return $self;
    }

    /**
     * What kind of email this is, for example `payment_successful`.
     */
    public function withEmailType(string $emailType): self
    {
        $self = clone $this;
        $self['emailType'] = $emailType;

        return $self;
    }

    /**
     * Whether this email has content to show. The content endpoint can still
     * refuse, because the content is removed after 180 days.
     */
    public function withHasPreview(bool $hasPreview): self
    {
        $self = clone $this;
        $self['hasPreview'] = $hasPreview;

        return $self;
    }

    /**
     * What you may do with this email.
     *
     * @param EmailPolicies|EmailPoliciesShape $policies
     */
    public function withPolicies(EmailPolicies|array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }

    /**
     * Where the email got to: sent, delivered, failed, complained or blocked.
     *
     * @param EmailLogStatus|value-of<EmailLogStatus> $status
     */
    public function withStatus(EmailLogStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

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
     * The address the email was sent from.
     */
    public function withFrom(?string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * What the merchant typed, when test mode redirected the send to the
     * business owner.
     */
    public function withIntendedRecipient(?string $intendedRecipient): self
    {
        $self = clone $this;
        $self['intendedRecipient'] = $intendedRecipient;

        return $self;
    }

    /**
     * The address the email reached.
     */
    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * The subject line as it was sent. Empty until the provider replicates.
     */
    public function withSubject(?string $subject): self
    {
        $self = clone $this;
        $self['subject'] = $subject;

        return $self;
    }
}
