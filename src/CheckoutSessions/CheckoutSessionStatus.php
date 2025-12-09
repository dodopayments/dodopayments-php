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
        $obj = new self;

        $obj['id'] = $id;
        $obj['createdAt'] = $createdAt;

        null !== $customerEmail && $obj['customerEmail'] = $customerEmail;
        null !== $customerName && $obj['customerName'] = $customerName;
        null !== $paymentID && $obj['paymentID'] = $paymentID;
        null !== $paymentStatus && $obj['paymentStatus'] = $paymentStatus;

        return $obj;
    }

    /**
     * Id of the checkout session.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Created at timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Customer email: prefers payment's customer, falls back to session.
     */
    public function withCustomerEmail(?string $customerEmail): self
    {
        $obj = clone $this;
        $obj['customerEmail'] = $customerEmail;

        return $obj;
    }

    /**
     * Customer name: prefers payment's customer, falls back to session.
     */
    public function withCustomerName(?string $customerName): self
    {
        $obj = clone $this;
        $obj['customerName'] = $customerName;

        return $obj;
    }

    /**
     * Id of the payment created by the checkout sessions.
     *
     * Null if checkout sessions is still at the details collection stage.
     */
    public function withPaymentID(?string $paymentID): self
    {
        $obj = clone $this;
        $obj['paymentID'] = $paymentID;

        return $obj;
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
        $obj = clone $this;
        $obj['paymentStatus'] = $paymentStatus;

        return $obj;
    }
}
