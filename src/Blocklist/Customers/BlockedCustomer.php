<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

use Dodopayments\Blocklist\Customers\Notes\BlockedCustomerNote;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BlockedCustomerNoteShape from \Dodopayments\Blocklist\Customers\Notes\BlockedCustomerNote
 *
 * @phpstan-type BlockedCustomerShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   customerEmail: string,
 *   customerID: string,
 *   customerName: string,
 *   identifier: string,
 *   source: BlockedCustomerSource|value-of<BlockedCustomerSource>,
 *   blockedByEmail?: string|null,
 *   cancelledSubscriptionIDs?: list<string>|null,
 *   notes?: list<BlockedCustomerNote|BlockedCustomerNoteShape>|null,
 *   reason?: string|null,
 *   remainingSubscriptionIDs?: list<string>|null,
 *   subscriptionsSwept?: bool|null,
 *   unblockedAt?: \DateTimeInterface|null,
 * }
 */
final class BlockedCustomer implements BaseModel
{
    /** @use SdkModel<BlockedCustomerShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('customer_email')]
    public string $customerEmail;

    #[Required('customer_id')]
    public string $customerID;

    #[Required('customer_name')]
    public string $customerName;

    /**
     * Customer id or email that the merchant supplied.
     */
    #[Required]
    public string $identifier;

    /**
     * Where a block came from. `Api` marks an API-key caller, which carries no
     * dashboard actor. The other values name the screen the merchant used.
     *
     * @var value-of<BlockedCustomerSource> $source
     */
    #[Required(enum: BlockedCustomerSource::class)]
    public string $source;

    /**
     * Dashboard user who blocked the customer. `null` for an API-key caller.
     */
    #[Optional('blocked_by_email', nullable: true)]
    public ?string $blockedByEmail;

    /**
     * Subscriptions this block cancelled. Present on the create response only.
     *
     * @var list<string>|null $cancelledSubscriptionIDs
     */
    #[Optional('cancelled_subscription_ids', list: 'string', nullable: true)]
    public ?array $cancelledSubscriptionIDs;

    /**
     * Activity log. Present on the detail response only.
     *
     * @var list<BlockedCustomerNote>|null $notes
     */
    #[Optional(list: BlockedCustomerNote::class, nullable: true)]
    public ?array $notes;

    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * Subscriptions this block left live, because the cancel failed or the
     * inline batch filled up. Repeat the create call to continue; the block
     * itself is already in force.
     *
     * @var list<string>|null $remainingSubscriptionIDs
     */
    #[Optional('remaining_subscription_ids', list: 'string', nullable: true)]
    public ?array $remainingSubscriptionIDs;

    /**
     * False when the block left live subscriptions behind, including the case
     * where the sweep could not list them and `remaining_subscription_ids` is
     * therefore unknown. Repeat the create call until it reads true.
     */
    #[Optional('subscriptions_swept', nullable: true)]
    public ?bool $subscriptionsSwept;

    #[Optional('unblocked_at', nullable: true)]
    public ?\DateTimeInterface $unblockedAt;

    /**
     * `new BlockedCustomer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockedCustomer::with(
     *   id: ...,
     *   createdAt: ...,
     *   customerEmail: ...,
     *   customerID: ...,
     *   customerName: ...,
     *   identifier: ...,
     *   source: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockedCustomer)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomerEmail(...)
     *   ->withCustomerID(...)
     *   ->withCustomerName(...)
     *   ->withIdentifier(...)
     *   ->withSource(...)
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
     * @param BlockedCustomerSource|value-of<BlockedCustomerSource> $source
     * @param list<string>|null $cancelledSubscriptionIDs
     * @param list<BlockedCustomerNote|BlockedCustomerNoteShape>|null $notes
     * @param list<string>|null $remainingSubscriptionIDs
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        string $customerEmail,
        string $customerID,
        string $customerName,
        string $identifier,
        BlockedCustomerSource|string $source,
        ?string $blockedByEmail = null,
        ?array $cancelledSubscriptionIDs = null,
        ?array $notes = null,
        ?string $reason = null,
        ?array $remainingSubscriptionIDs = null,
        ?bool $subscriptionsSwept = null,
        ?\DateTimeInterface $unblockedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['customerEmail'] = $customerEmail;
        $self['customerID'] = $customerID;
        $self['customerName'] = $customerName;
        $self['identifier'] = $identifier;
        $self['source'] = $source;

        null !== $blockedByEmail && $self['blockedByEmail'] = $blockedByEmail;
        null !== $cancelledSubscriptionIDs && $self['cancelledSubscriptionIDs'] = $cancelledSubscriptionIDs;
        null !== $notes && $self['notes'] = $notes;
        null !== $reason && $self['reason'] = $reason;
        null !== $remainingSubscriptionIDs && $self['remainingSubscriptionIDs'] = $remainingSubscriptionIDs;
        null !== $subscriptionsSwept && $self['subscriptionsSwept'] = $subscriptionsSwept;
        null !== $unblockedAt && $self['unblockedAt'] = $unblockedAt;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCustomerEmail(string $customerEmail): self
    {
        $self = clone $this;
        $self['customerEmail'] = $customerEmail;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withCustomerName(string $customerName): self
    {
        $self = clone $this;
        $self['customerName'] = $customerName;

        return $self;
    }

    /**
     * Customer id or email that the merchant supplied.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * Where a block came from. `Api` marks an API-key caller, which carries no
     * dashboard actor. The other values name the screen the merchant used.
     *
     * @param BlockedCustomerSource|value-of<BlockedCustomerSource> $source
     */
    public function withSource(BlockedCustomerSource|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Dashboard user who blocked the customer. `null` for an API-key caller.
     */
    public function withBlockedByEmail(?string $blockedByEmail): self
    {
        $self = clone $this;
        $self['blockedByEmail'] = $blockedByEmail;

        return $self;
    }

    /**
     * Subscriptions this block cancelled. Present on the create response only.
     *
     * @param list<string>|null $cancelledSubscriptionIDs
     */
    public function withCancelledSubscriptionIDs(
        ?array $cancelledSubscriptionIDs
    ): self {
        $self = clone $this;
        $self['cancelledSubscriptionIDs'] = $cancelledSubscriptionIDs;

        return $self;
    }

    /**
     * Activity log. Present on the detail response only.
     *
     * @param list<BlockedCustomerNote|BlockedCustomerNoteShape>|null $notes
     */
    public function withNotes(?array $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }

    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Subscriptions this block left live, because the cancel failed or the
     * inline batch filled up. Repeat the create call to continue; the block
     * itself is already in force.
     *
     * @param list<string>|null $remainingSubscriptionIDs
     */
    public function withRemainingSubscriptionIDs(
        ?array $remainingSubscriptionIDs
    ): self {
        $self = clone $this;
        $self['remainingSubscriptionIDs'] = $remainingSubscriptionIDs;

        return $self;
    }

    /**
     * False when the block left live subscriptions behind, including the case
     * where the sweep could not list them and `remaining_subscription_ids` is
     * therefore unknown. Repeat the create call until it reads true.
     */
    public function withSubscriptionsSwept(?bool $subscriptionsSwept): self
    {
        $self = clone $this;
        $self['subscriptionsSwept'] = $subscriptionsSwept;

        return $self;
    }

    public function withUnblockedAt(?\DateTimeInterface $unblockedAt): self
    {
        $self = clone $this;
        $self['unblockedAt'] = $unblockedAt;

        return $self;
    }
}
