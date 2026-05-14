<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\Subscription;

/**
 * @phpstan-import-type SubscriptionShape from \Dodopayments\Subscriptions\Subscription
 *
 * @phpstan-type SubscriptionPlanChangedWebhookEventShape = array{
 *   businessID: string,
 *   data: Subscription|SubscriptionShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'subscription.plan_changed',
 * }
 */
final class SubscriptionPlanChangedWebhookEvent implements BaseModel
{
    /** @use SdkModel<SubscriptionPlanChangedWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'subscription.plan_changed' $type
     */
    #[Required]
    public string $type = 'subscription.plan_changed';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Response struct representing subscription details.
     */
    #[Required]
    public Subscription $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new SubscriptionPlanChangedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionPlanChangedWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionPlanChangedWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
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
     * @param Subscription|SubscriptionShape $data
     */
    public static function with(
        string $businessID,
        Subscription|array $data,
        \DateTimeInterface $timestamp
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Response struct representing subscription details.
     *
     * @param Subscription|SubscriptionShape $data
     */
    public function withData(Subscription|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The event type.
     *
     * @param 'subscription.plan_changed' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
