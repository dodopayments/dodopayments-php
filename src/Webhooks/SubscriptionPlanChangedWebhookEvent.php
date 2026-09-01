<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Webhooks\SubscriptionPlanChangedWebhookEvent\Data;

/**
 * @phpstan-import-type DataShape from \Dodopayments\Webhooks\SubscriptionPlanChangedWebhookEvent\Data
 *
 * @phpstan-type SubscriptionPlanChangedWebhookEventShape = array{
 *   businessID: string,
 *   data: Data|DataShape,
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
     * Subscription payload sent on a webhook. It carries every field of
     * `SubscriptionResponse`, plus the grace-period deadline.
     */
    #[Required]
    public Data $data;

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
     * @param Data|DataShape $data
     */
    public static function with(
        string $businessID,
        Data|array $data,
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
     * Subscription payload sent on a webhook. It carries every field of
     * `SubscriptionResponse`, plus the grace-period deadline.
     *
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
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
