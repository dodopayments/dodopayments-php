<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The service period that a payment pays for, for one subscription.
 *
 * @phpstan-type SubscriptionServicePeriodShape = array{
 *   endsAt: \DateTimeInterface,
 *   startsAt: \DateTimeInterface,
 *   subscriptionID: string,
 * }
 */
final class SubscriptionServicePeriod implements BaseModel
{
    /** @use SdkModel<SubscriptionServicePeriodShape> */
    use SdkModel;

    /**
     * End of the service period.
     */
    #[Required('ends_at')]
    public \DateTimeInterface $endsAt;

    /**
     * Start of the service period. For a renewal, this is the billing date. For a
     * plan change that applies at the next billing date, this is the time when the
     * change applied. This time can be some minutes after the billing date.
     */
    #[Required('starts_at')]
    public \DateTimeInterface $startsAt;

    /**
     * Identifier of the subscription.
     */
    #[Required('subscription_id')]
    public string $subscriptionID;

    /**
     * `new SubscriptionServicePeriod()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionServicePeriod::with(endsAt: ..., startsAt: ..., subscriptionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionServicePeriod)
     *   ->withEndsAt(...)
     *   ->withStartsAt(...)
     *   ->withSubscriptionID(...)
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
     */
    public static function with(
        \DateTimeInterface $endsAt,
        \DateTimeInterface $startsAt,
        string $subscriptionID,
    ): self {
        $self = new self;

        $self['endsAt'] = $endsAt;
        $self['startsAt'] = $startsAt;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * End of the service period.
     */
    public function withEndsAt(\DateTimeInterface $endsAt): self
    {
        $self = clone $this;
        $self['endsAt'] = $endsAt;

        return $self;
    }

    /**
     * Start of the service period. For a renewal, this is the billing date. For a
     * plan change that applies at the next billing date, this is the time when the
     * change applied. This time can be some minutes after the billing date.
     */
    public function withStartsAt(\DateTimeInterface $startsAt): self
    {
        $self = clone $this;
        $self['startsAt'] = $startsAt;

        return $self;
    }

    /**
     * Identifier of the subscription.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
