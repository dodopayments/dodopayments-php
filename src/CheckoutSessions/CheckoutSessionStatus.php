<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\IntentStatus;

/**
 * @phpstan-type CheckoutSessionStatusShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   customerEmail?: string|null,
 *   customerName?: string|null,
 *   paymentID?: string|null,
 *   paymentStatus?: value-of<IntentStatus>|null,
 * }
 */
final class CheckoutSessionStatus implements BaseModel
{
    /** @use SdkModel<CheckoutSessionStatusShape> */
    use SdkModel;

    /**
     * Id of the checkout session.
     */
    #[Required]
    public string $id;

    /**
     * Created at timestamp.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Customer email: prefers payment's customer, falls back to session.
     */
    #[Optional('customer_email', nullable: true)]
    public ?string $customerEmail;

    /**
     * Customer name: prefers payment's customer, falls back to session.
     */
    #[Optional('customer_name', nullable: true)]
    public ?string $customerName;

    /**
     * Id of the payment created by the checkout sessions.
     *
     * Null if checkout sessions is still at the details collection stage.
     */
    #[Optional('payment_id', nullable: true)]
    public ?string $paymentID;

    /**
     * status of the payment.
     *
     * Null if checkout sessions is still at the details collection stage.
     *
     * @var value-of<IntentStatus>|null $paymentStatus
     */
    #[Optional('payment_status', enum: IntentStatus::class, nullable: true)]
    public ?string $paymentStatus;

    /**
     * `new CheckoutSessionStatus()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionStatus::with(id: ..., createdAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckoutSessionStatus)->withID(...)->withCreatedAt(...)
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
     * @param IntentStatus|value-of<IntentStatus>|null $paymentStatus
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        ?string $customerEmail = null,
        ?string $customerName = null,
        ?string $paymentID = null,
        IntentStatus|string|null $paymentStatus = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;

        null !== $customerEmail && $self['customerEmail'] = $customerEmail;
        null !== $customerName && $self['customerName'] = $customerName;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $paymentStatus && $self['paymentStatus'] = $paymentStatus;

        return $self;
    }

    /**
     * Id of the checkout session.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Created at timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Customer email: prefers payment's customer, falls back to session.
     */
    public function withCustomerEmail(?string $customerEmail): self
    {
        $self = clone $this;
        $self['customerEmail'] = $customerEmail;

        return $self;
    }

    /**
     * Customer name: prefers payment's customer, falls back to session.
     */
    public function withCustomerName(?string $customerName): self
    {
        $self = clone $this;
        $self['customerName'] = $customerName;

        return $self;
    }

    /**
     * Id of the payment created by the checkout sessions.
     *
     * Null if checkout sessions is still at the details collection stage.
     */
    public function withPaymentID(?string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * status of the payment.
     *
     * Null if checkout sessions is still at the details collection stage.
     *
     * @param IntentStatus|value-of<IntentStatus>|null $paymentStatus
     */
    public function withPaymentStatus(
        IntentStatus|string|null $paymentStatus
    ): self {
        $self = clone $this;
        $self['paymentStatus'] = $paymentStatus;

        return $self;
    }
}
