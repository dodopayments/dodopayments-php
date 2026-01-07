<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Webhooks\SubscriptionCancelledWebhookEvent\Type;

/**
 * @phpstan-import-type SubscriptionShape from \Dodopayments\Subscriptions\Subscription
 *
 * @phpstan-type SubscriptionCancelledWebhookEventShape = array{
 *   businessID: string,
 *   data: Subscription|SubscriptionShape,
 *   timestamp: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 * }
 */
final class SubscriptionCancelledWebhookEvent implements BaseModel
{
    /** @use SdkModel<SubscriptionCancelledWebhookEventShape> */
    use SdkModel;

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
     * The event type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new SubscriptionCancelledWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionCancelledWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionCancelledWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
     *   ->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $businessID,
        Subscription|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;

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
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
