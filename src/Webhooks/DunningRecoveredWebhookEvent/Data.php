<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DunningRecoveredWebhookEvent;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Webhooks\DunningRecoveredWebhookEvent\Data\Status;
use Dodopayments\Webhooks\DunningRecoveredWebhookEvent\Data\TriggerState;

/**
 * Webhook payload for dunning.started and dunning.recovered events.
 *
 * @phpstan-type DataShape = array{
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   status: Status|value-of<Status>,
 *   subscriptionID: string,
 *   triggerState: TriggerState|value-of<TriggerState>,
 *   paymentID?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('customer_id')]
    public string $customerID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required('subscription_id')]
    public string $subscriptionID;

    /** @var value-of<TriggerState> $triggerState */
    #[Required('trigger_state', enum: TriggerState::class)]
    public string $triggerState;

    #[Optional('payment_id', nullable: true)]
    public ?string $paymentID;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   createdAt: ...,
     *   customerID: ...,
     *   status: ...,
     *   subscriptionID: ...,
     *   triggerState: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withCreatedAt(...)
     *   ->withCustomerID(...)
     *   ->withStatus(...)
     *   ->withSubscriptionID(...)
     *   ->withTriggerState(...)
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
     * @param Status|value-of<Status> $status
     * @param TriggerState|value-of<TriggerState> $triggerState
     */
    public static function with(
        \DateTimeInterface $createdAt,
        string $customerID,
        Status|string $status,
        string $subscriptionID,
        TriggerState|string $triggerState,
        ?string $paymentID = null,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['customerID'] = $customerID;
        $self['status'] = $status;
        $self['subscriptionID'] = $subscriptionID;
        $self['triggerState'] = $triggerState;

        null !== $paymentID && $self['paymentID'] = $paymentID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

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

    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * @param TriggerState|value-of<TriggerState> $triggerState
     */
    public function withTriggerState(TriggerState|string $triggerState): self
    {
        $self = clone $this;
        $self['triggerState'] = $triggerState;

        return $self;
    }

    public function withPaymentID(?string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }
}
