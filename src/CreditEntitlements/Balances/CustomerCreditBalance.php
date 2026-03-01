<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Response for a customer's credit balance.
 *
 * @phpstan-type CustomerCreditBalanceShape = array{
 *   id: string,
 *   balance: string,
 *   createdAt: \DateTimeInterface,
 *   creditEntitlementID: string,
 *   customerID: string,
 *   overage: string,
 *   updatedAt: \DateTimeInterface,
 *   lastTransactionAt?: \DateTimeInterface|null,
 * }
 */
final class CustomerCreditBalance implements BaseModel
{
    /** @use SdkModel<CustomerCreditBalanceShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $balance;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('customer_id')]
    public string $customerID;

    #[Required]
    public string $overage;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional('last_transaction_at', nullable: true)]
    public ?\DateTimeInterface $lastTransactionAt;

    /**
     * `new CustomerCreditBalance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerCreditBalance::with(
     *   id: ...,
     *   balance: ...,
     *   createdAt: ...,
     *   creditEntitlementID: ...,
     *   customerID: ...,
     *   overage: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerCreditBalance)
     *   ->withID(...)
     *   ->withBalance(...)
     *   ->withCreatedAt(...)
     *   ->withCreditEntitlementID(...)
     *   ->withCustomerID(...)
     *   ->withOverage(...)
     *   ->withUpdatedAt(...)
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
        string $id,
        string $balance,
        \DateTimeInterface $createdAt,
        string $creditEntitlementID,
        string $customerID,
        string $overage,
        \DateTimeInterface $updatedAt,
        ?\DateTimeInterface $lastTransactionAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['balance'] = $balance;
        $self['createdAt'] = $createdAt;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['customerID'] = $customerID;
        $self['overage'] = $overage;
        $self['updatedAt'] = $updatedAt;

        null !== $lastTransactionAt && $self['lastTransactionAt'] = $lastTransactionAt;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withBalance(string $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withOverage(string $overage): self
    {
        $self = clone $this;
        $self['overage'] = $overage;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withLastTransactionAt(
        ?\DateTimeInterface $lastTransactionAt
    ): self {
        $self = clone $this;
        $self['lastTransactionAt'] = $lastTransactionAt;

        return $self;
    }
}
