<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ManualRetryShape = array{
 *   invoiceID: string,
 *   isManualRetry: bool,
 *   paymentID: string,
 *   retryAttempt: int,
 *   sendsAllowed: int,
 *   sendsUsed: int,
 *   retryAvailableAt?: \DateTimeInterface|null,
 *   status?: null|IntentStatus|value-of<IntentStatus>,
 * }
 */
final class ManualRetry implements BaseModel
{
    /** @use SdkModel<ManualRetryShape> */
    use SdkModel;

    /**
     * The invoice the send charged.
     */
    #[Required('invoice_id')]
    public string $invoiceID;

    /**
     * Always true on this route. Tells the row apart from an automatic attempt.
     */
    #[Required('is_manual_retry')]
    public bool $isManualRetry;

    /**
     * The payment row this send created.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * Which attempt this send is, counting manual sends on the invoice.
     */
    #[Required('retry_attempt')]
    public int $retryAttempt;

    #[Required('sends_allowed')]
    public int $sendsAllowed;

    /**
     * Manual sends spent on this invoice, including this one.
     */
    #[Required('sends_used')]
    public int $sendsUsed;

    /**
     * When the next send becomes available. Null when no send is left.
     */
    #[Optional('retry_available_at', nullable: true)]
    public ?\DateTimeInterface $retryAvailableAt;

    /**
     * Outcome of the charge. `processing` means the processor has not settled it
     * yet, and the payment webhooks report the result.
     *
     * @var value-of<IntentStatus>|null $status
     */
    #[Optional(enum: IntentStatus::class, nullable: true)]
    public ?string $status;

    /**
     * `new ManualRetry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ManualRetry::with(
     *   invoiceID: ...,
     *   isManualRetry: ...,
     *   paymentID: ...,
     *   retryAttempt: ...,
     *   sendsAllowed: ...,
     *   sendsUsed: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ManualRetry)
     *   ->withInvoiceID(...)
     *   ->withIsManualRetry(...)
     *   ->withPaymentID(...)
     *   ->withRetryAttempt(...)
     *   ->withSendsAllowed(...)
     *   ->withSendsUsed(...)
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
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public static function with(
        string $invoiceID,
        bool $isManualRetry,
        string $paymentID,
        int $retryAttempt,
        int $sendsAllowed,
        int $sendsUsed,
        ?\DateTimeInterface $retryAvailableAt = null,
        IntentStatus|string|null $status = null,
    ): self {
        $self = new self;

        $self['invoiceID'] = $invoiceID;
        $self['isManualRetry'] = $isManualRetry;
        $self['paymentID'] = $paymentID;
        $self['retryAttempt'] = $retryAttempt;
        $self['sendsAllowed'] = $sendsAllowed;
        $self['sendsUsed'] = $sendsUsed;

        null !== $retryAvailableAt && $self['retryAvailableAt'] = $retryAvailableAt;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The invoice the send charged.
     */
    public function withInvoiceID(string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    /**
     * Always true on this route. Tells the row apart from an automatic attempt.
     */
    public function withIsManualRetry(bool $isManualRetry): self
    {
        $self = clone $this;
        $self['isManualRetry'] = $isManualRetry;

        return $self;
    }

    /**
     * The payment row this send created.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Which attempt this send is, counting manual sends on the invoice.
     */
    public function withRetryAttempt(int $retryAttempt): self
    {
        $self = clone $this;
        $self['retryAttempt'] = $retryAttempt;

        return $self;
    }

    public function withSendsAllowed(int $sendsAllowed): self
    {
        $self = clone $this;
        $self['sendsAllowed'] = $sendsAllowed;

        return $self;
    }

    /**
     * Manual sends spent on this invoice, including this one.
     */
    public function withSendsUsed(int $sendsUsed): self
    {
        $self = clone $this;
        $self['sendsUsed'] = $sendsUsed;

        return $self;
    }

    /**
     * When the next send becomes available. Null when no send is left.
     */
    public function withRetryAvailableAt(
        ?\DateTimeInterface $retryAvailableAt
    ): self {
        $self = clone $this;
        $self['retryAvailableAt'] = $retryAvailableAt;

        return $self;
    }

    /**
     * Outcome of the charge. `processing` means the processor has not settled it
     * yet, and the payment webhooks report the result.
     *
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public function withStatus(IntentStatus|string|null $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
