<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\IntentStatus;

/**
 * @phpstan-type CheckoutSessionStatusShape = array{
 *   id: string,
 *   created_at: \DateTimeInterface,
 *   customer_email?: string|null,
 *   customer_name?: string|null,
 *   payment_id?: string|null,
 *   payment_status?: value-of<IntentStatus>|null,
 * }
 */
final class CheckoutSessionStatus implements BaseModel
{
    /** @use SdkModel<CheckoutSessionStatusShape> */
    use SdkModel;

    /**
     * Id of the checkout session.
     */
    #[Api]
    public string $id;

    /**
     * Created at timestamp.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * Customer email: prefers payment's customer, falls back to session.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $customer_email;

    /**
     * Customer name: prefers payment's customer, falls back to session.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $customer_name;

    /**
     * Id of the payment created by the checkout sessions.
     *
     * Null if checkout sessions is still at the details collection stage.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $payment_id;

    /**
     * status of the payment.
     *
     * Null if checkout sessions is still at the details collection stage.
     *
     * @var value-of<IntentStatus>|null $payment_status
     */
    #[Api(enum: IntentStatus::class, nullable: true, optional: true)]
    public ?string $payment_status;

    /**
     * `new CheckoutSessionStatus()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionStatus::with(id: ..., created_at: ...)
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
     * @param IntentStatus|value-of<IntentStatus>|null $payment_status
     */
    public static function with(
        string $id,
        \DateTimeInterface $created_at,
        ?string $customer_email = null,
        ?string $customer_name = null,
        ?string $payment_id = null,
        IntentStatus|string|null $payment_status = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['created_at'] = $created_at;

        null !== $customer_email && $obj['customer_email'] = $customer_email;
        null !== $customer_name && $obj['customer_name'] = $customer_name;
        null !== $payment_id && $obj['payment_id'] = $payment_id;
        null !== $payment_status && $obj['payment_status'] = $payment_status;

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
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * Customer email: prefers payment's customer, falls back to session.
     */
    public function withCustomerEmail(?string $customerEmail): self
    {
        $obj = clone $this;
        $obj['customer_email'] = $customerEmail;

        return $obj;
    }

    /**
     * Customer name: prefers payment's customer, falls back to session.
     */
    public function withCustomerName(?string $customerName): self
    {
        $obj = clone $this;
        $obj['customer_name'] = $customerName;

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
        $obj['payment_id'] = $paymentID;

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
        $obj['payment_status'] = $paymentStatus;

        return $obj;
    }
}
