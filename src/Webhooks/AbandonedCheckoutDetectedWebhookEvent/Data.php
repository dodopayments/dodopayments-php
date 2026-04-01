<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\AbandonedCheckoutDetectedWebhookEvent;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Webhooks\AbandonedCheckoutDetectedWebhookEvent\Data\AbandonmentReason;
use Dodopayments\Webhooks\AbandonedCheckoutDetectedWebhookEvent\Data\Status;

/**
 * Webhook payload for abandoned_checkout.detected and abandoned_checkout.recovered events.
 *
 * @phpstan-type DataShape = array{
 *   abandonedAt: \DateTimeInterface,
 *   abandonmentReason: AbandonmentReason|value-of<AbandonmentReason>,
 *   customerID: string,
 *   paymentID: string,
 *   status: Status|value-of<Status>,
 *   recoveredPaymentID?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required('abandoned_at')]
    public \DateTimeInterface $abandonedAt;

    /** @var value-of<AbandonmentReason> $abandonmentReason */
    #[Required('abandonment_reason', enum: AbandonmentReason::class)]
    public string $abandonmentReason;

    #[Required('customer_id')]
    public string $customerID;

    #[Required('payment_id')]
    public string $paymentID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Optional('recovered_payment_id', nullable: true)]
    public ?string $recoveredPaymentID;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   abandonedAt: ...,
     *   abandonmentReason: ...,
     *   customerID: ...,
     *   paymentID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withAbandonedAt(...)
     *   ->withAbandonmentReason(...)
     *   ->withCustomerID(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        \DateTimeInterface $abandonedAt,
        AbandonmentReason|string $abandonmentReason,
        string $customerID,
        string $paymentID,
        Status|string $status,
        ?string $recoveredPaymentID = null,
    ): self {
        $self = new self;

        $self['abandonedAt'] = $abandonedAt;
        $self['abandonmentReason'] = $abandonmentReason;
        $self['customerID'] = $customerID;
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
