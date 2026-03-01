<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionGetCreditUsageResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Per-entitlement credit usage status for a subscription.
 *
 * @phpstan-type ItemShape = array{
 *   balance: string,
 *   creditEntitlementID: string,
 *   creditEntitlementName: string,
 *   limitReached: bool,
 *   overage: string,
 *   overageEnabled: bool,
 *   unit: string,
 *   overageLimit?: string|null,
 *   remainingHeadroom?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * Customer's current credit balance for this entitlement (customer-wide).
     */
    #[Required]
    public string $balance;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('credit_entitlement_name')]
    public string $creditEntitlementName;

    /**
     * True if overage has reached or exceeded the limit.
     * When true, further deductions that would increase overage will fail.
     */
    #[Required('limit_reached')]
    public bool $limitReached;

    /**
     * Current overage amount accrued (customer-wide).
     */
    #[Required]
    public string $overage;

    /**
     * Whether overage is enabled for this entitlement on this subscription.
     */
    #[Required('overage_enabled')]
    public bool $overageEnabled;

    /**
     * Unit label for the credit entitlement (e.g. "API Calls", "Tokens").
     */
    #[Required]
    public string $unit;

    /**
     * Maximum allowed overage before deductions are blocked.
     * None means unlimited overage (when overage_enabled is true).
     */
    #[Optional('overage_limit', nullable: true)]
    public ?string $overageLimit;

    /**
     * How much more overage can accumulate before being blocked.
     * None if overage is not enabled or there is no limit (unlimited).
     * A value of 0 means the next deduction that increases overage will be blocked.
     */
    #[Optional('remaining_headroom', nullable: true)]
    public ?string $remainingHeadroom;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   balance: ...,
     *   creditEntitlementID: ...,
     *   creditEntitlementName: ...,
     *   limitReached: ...,
     *   overage: ...,
     *   overageEnabled: ...,
     *   unit: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withBalance(...)
     *   ->withCreditEntitlementID(...)
     *   ->withCreditEntitlementName(...)
     *   ->withLimitReached(...)
     *   ->withOverage(...)
     *   ->withOverageEnabled(...)
     *   ->withUnit(...)
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
        string $balance,
        string $creditEntitlementID,
        string $creditEntitlementName,
        bool $limitReached,
        string $overage,
        bool $overageEnabled,
        string $unit,
        ?string $overageLimit = null,
        ?string $remainingHeadroom = null,
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['creditEntitlementName'] = $creditEntitlementName;
        $self['limitReached'] = $limitReached;
        $self['overage'] = $overage;
        $self['overageEnabled'] = $overageEnabled;
        $self['unit'] = $unit;

        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
        null !== $remainingHeadroom && $self['remainingHeadroom'] = $remainingHeadroom;

        return $self;
    }

    /**
     * Customer's current credit balance for this entitlement (customer-wide).
     */
    public function withBalance(string $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    public function withCreditEntitlementName(
        string $creditEntitlementName
    ): self {
        $self = clone $this;
        $self['creditEntitlementName'] = $creditEntitlementName;

        return $self;
    }

    /**
     * True if overage has reached or exceeded the limit.
     * When true, further deductions that would increase overage will fail.
     */
    public function withLimitReached(bool $limitReached): self
    {
        $self = clone $this;
        $self['limitReached'] = $limitReached;

        return $self;
    }

    /**
     * Current overage amount accrued (customer-wide).
     */
    public function withOverage(string $overage): self
    {
        $self = clone $this;
        $self['overage'] = $overage;

        return $self;
    }

    /**
     * Whether overage is enabled for this entitlement on this subscription.
     */
    public function withOverageEnabled(bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    /**
     * Unit label for the credit entitlement (e.g. "API Calls", "Tokens").
     */
    public function withUnit(string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }

    /**
     * Maximum allowed overage before deductions are blocked.
     * None means unlimited overage (when overage_enabled is true).
     */
    public function withOverageLimit(?string $overageLimit): self
    {
        $self = clone $this;
        $self['overageLimit'] = $overageLimit;

        return $self;
    }

    /**
     * How much more overage can accumulate before being blocked.
     * None if overage is not enabled or there is no limit (unlimited).
     * A value of 0 means the next deduction that increases overage will be blocked.
     */
    public function withRemainingHeadroom(?string $remainingHeadroom): self
    {
        $self = clone $this;
        $self['remainingHeadroom'] = $remainingHeadroom;

        return $self;
    }
}
