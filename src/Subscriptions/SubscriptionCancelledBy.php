<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionCancelledBy\ActorType;

/**
 * The caller that cancelled a subscription or scheduled its cancel.
 *
 * @phpstan-type SubscriptionCancelledByShape = array{
 *   actorType: ActorType|value-of<ActorType>,
 *   email?: string|null,
 *   name?: string|null,
 * }
 */
final class SubscriptionCancelledBy implements BaseModel
{
    /** @use SdkModel<SubscriptionCancelledByShape> */
    use SdkModel;

    /**
     * The kind of caller.
     *
     * @var value-of<ActorType> $actorType
     */
    #[Required('actor_type', enum: ActorType::class)]
    public string $actorType;

    /**
     * Email of the customer or of the dashboard user. `null` for an API key
     * or the Dodo Payments team.
     */
    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * Name of the customer or of the dashboard user. `null` for an API key
     * or the Dodo Payments team.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new SubscriptionCancelledBy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionCancelledBy::with(actorType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionCancelledBy)->withActorType(...)
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
     * @param ActorType|value-of<ActorType> $actorType
     */
    public static function with(
        ActorType|string $actorType,
        ?string $email = null,
        ?string $name = null
    ): self {
        $self = new self;

        $self['actorType'] = $actorType;

        null !== $email && $self['email'] = $email;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The kind of caller.
     *
     * @param ActorType|value-of<ActorType> $actorType
     */
    public function withActorType(ActorType|string $actorType): self
    {
        $self = clone $this;
        $self['actorType'] = $actorType;

        return $self;
    }

    /**
     * Email of the customer or of the dashboard user. `null` for an API key
     * or the Dodo Payments team.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Name of the customer or of the dashboard user. `null` for an API key
     * or the Dodo Payments team.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
