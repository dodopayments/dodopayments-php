<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerListCreditEntitlementsResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * A credit entitlement with the customer's current balance.
 *
 * @phpstan-type ItemShape = array{
 *   balance: string,
 *   creditEntitlementID: string,
 *   name: string,
 *   overage: string,
 *   unit: string,
 *   description?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * Customer's current remaining credit balance.
     */
    #[Required]
    public string $balance;

    /**
     * Credit entitlement ID.
     */
    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    /**
     * Name of the credit entitlement.
     */
    #[Required]
    public string $name;

    /**
     * Customer's current overage balance.
     */
    #[Required]
    public string $overage;

    /**
     * Unit label (e.g. "API Calls", "Tokens").
     */
    #[Required]
    public string $unit;

    /**
     * Description of the credit entitlement.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   balance: ..., creditEntitlementID: ..., name: ..., overage: ..., unit: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withBalance(...)
     *   ->withCreditEntitlementID(...)
     *   ->withName(...)
     *   ->withOverage(...)
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
        string $name,
        string $overage,
        string $unit,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['name'] = $name;
        $self['overage'] = $overage;
        $self['unit'] = $unit;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Customer's current remaining credit balance.
     */
    public function withBalance(string $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    /**
     * Credit entitlement ID.
     */
    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Name of the credit entitlement.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Customer's current overage balance.
     */
    public function withOverage(string $overage): self
    {
        $self = clone $this;
        $self['overage'] = $overage;

        return $self;
    }

    /**
     * Unit label (e.g. "API Calls", "Tokens").
     */
    public function withUnit(string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }

    /**
     * Description of the credit entitlement.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
