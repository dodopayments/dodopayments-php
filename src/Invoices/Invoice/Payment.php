<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\IntentStatus;

/**
 * @phpstan-type PaymentShape = array{
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   paymentID: string,
 *   retryAttempt?: int|null,
 *   status?: null|IntentStatus|value-of<IntentStatus>,
 * }
 */
final class Payment implements BaseModel
{
    /** @use SdkModel<PaymentShape> */
    use SdkModel;

    #[Required]
    public int $amount;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('payment_id')]
    public string $paymentID;

    /**
     * The automatic charge number. `null` for a payment that the customer started.
     */
    #[Optional('retry_attempt', nullable: true)]
    public ?int $retryAttempt;

    /**
     * `null` while the processor has not answered.
     *
     * @var value-of<IntentStatus>|null $status
     */
    #[Optional(enum: IntentStatus::class, nullable: true)]
    public ?string $status;

    /**
     * `new Payment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payment::with(amount: ..., createdAt: ..., paymentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Payment)->withAmount(...)->withCreatedAt(...)->withPaymentID(...)
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
        int $amount,
        \DateTimeInterface $createdAt,
        string $paymentID,
        ?int $retryAttempt = null,
        IntentStatus|string|null $status = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['paymentID'] = $paymentID;

        null !== $retryAttempt && $self['retryAttempt'] = $retryAttempt;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * The automatic charge number. `null` for a payment that the customer started.
     */
    public function withRetryAttempt(?int $retryAttempt): self
    {
        $self = clone $this;
        $self['retryAttempt'] = $retryAttempt;

        return $self;
    }

    /**
     * `null` while the processor has not answered.
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
