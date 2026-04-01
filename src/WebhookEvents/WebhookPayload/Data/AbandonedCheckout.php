<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\AbandonedCheckout\AbandonmentReason;
use Dodopayments\WebhookEvents\WebhookPayload\Data\AbandonedCheckout\PayloadType;
use Dodopayments\WebhookEvents\WebhookPayload\Data\AbandonedCheckout\Status;

/**
 * @phpstan-type AbandonedCheckoutShape = array{
 *   abandonedAt: \DateTimeInterface,
 *   abandonmentReason: AbandonmentReason|value-of<AbandonmentReason>,
 *   customerID: string,
 *   payloadType: PayloadType|value-of<PayloadType>,
 *   paymentID: string,
 *   status: Status|value-of<Status>,
 *   recoveredPaymentID?: string|null,
 * }
 */
final class AbandonedCheckout implements BaseModel
{
    /** @use SdkModel<AbandonedCheckoutShape> */
    use SdkModel;

    #[Required('abandoned_at')]
    public \DateTimeInterface $abandonedAt;

    /** @var value-of<AbandonmentReason> $abandonmentReason */
    #[Required('abandonment_reason', enum: AbandonmentReason::class)]
    public string $abandonmentReason;

    #[Required('customer_id')]
    public string $customerID;

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    #[Required('payment_id')]
    public string $paymentID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Optional('recovered_payment_id', nullable: true)]
    public ?string $recoveredPaymentID;

    /**
     * `new AbandonedCheckout()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AbandonedCheckout::with(
     *   abandonedAt: ...,
     *   abandonmentReason: ...,
     *   customerID: ...,
     *   payloadType: ...,
     *   paymentID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AbandonedCheckout)
     *   ->withAbandonedAt(...)
     *   ->withAbandonmentReason(...)
     *   ->withCustomerID(...)
     *   ->withPayloadType(...)
     *   ->withPaymentID(...)
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
     * @param AbandonmentReason|value-of<AbandonmentReason> $abandonmentReason
     * @param PayloadType|value-of<PayloadType> $payloadType
     * @param Status|value-of<Status> $status
     */
    public static function with(
        \DateTimeInterface $abandonedAt,
        AbandonmentReason|string $abandonmentReason,
        string $customerID,
        PayloadType|string $payloadType,
        string $paymentID,
        Status|string $status,
        ?string $recoveredPaymentID = null,
    ): self {
        $self = new self;

        $self['abandonedAt'] = $abandonedAt;
        $self['abandonmentReason'] = $abandonmentReason;
        $self['customerID'] = $customerID;
        $self['payloadType'] = $payloadType;
        $self['paymentID'] = $paymentID;
        $self['status'] = $status;

        null !== $recoveredPaymentID && $self['recoveredPaymentID'] = $recoveredPaymentID;

        return $self;
    }

    public function withAbandonedAt(\DateTimeInterface $abandonedAt): self
    {
        $self = clone $this;
        $self['abandonedAt'] = $abandonedAt;

        return $self;
    }

    /**
     * @param AbandonmentReason|value-of<AbandonmentReason> $abandonmentReason
     */
    public function withAbandonmentReason(
        AbandonmentReason|string $abandonmentReason
    ): self {
        $self = clone $this;
        $self['abandonmentReason'] = $abandonmentReason;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }

    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withRecoveredPaymentID(?string $recoveredPaymentID): self
    {
        $self = clone $this;
        $self['recoveredPaymentID'] = $recoveredPaymentID;

        return $self;
    }
}
