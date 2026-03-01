<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Response for creating a ledger entry.
 *
 * @phpstan-type BalanceNewLedgerEntryResponseShape = array{
 *   id: string,
 *   amount: string,
 *   balanceAfter: string,
 *   balanceBefore: string,
 *   createdAt: \DateTimeInterface,
 *   creditEntitlementID: string,
 *   customerID: string,
 *   entryType: LedgerEntryType|value-of<LedgerEntryType>,
 *   isCredit: bool,
 *   overageAfter: string,
 *   overageBefore: string,
 *   grantID?: string|null,
 *   reason?: string|null,
 * }
 */
final class BalanceNewLedgerEntryResponse implements BaseModel
{
    /** @use SdkModel<BalanceNewLedgerEntryResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $amount;

    #[Required('balance_after')]
    public string $balanceAfter;

    #[Required('balance_before')]
    public string $balanceBefore;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('customer_id')]
    public string $customerID;

    /** @var value-of<LedgerEntryType> $entryType */
    #[Required('entry_type', enum: LedgerEntryType::class)]
    public string $entryType;

    #[Required('is_credit')]
    public bool $isCredit;

    #[Required('overage_after')]
    public string $overageAfter;

    #[Required('overage_before')]
    public string $overageBefore;

    #[Optional('grant_id', nullable: true)]
    public ?string $grantID;

    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * `new BalanceNewLedgerEntryResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceNewLedgerEntryResponse::with(
     *   id: ...,
     *   amount: ...,
     *   balanceAfter: ...,
     *   balanceBefore: ...,
     *   createdAt: ...,
     *   creditEntitlementID: ...,
     *   customerID: ...,
     *   entryType: ...,
     *   isCredit: ...,
     *   overageAfter: ...,
     *   overageBefore: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceNewLedgerEntryResponse)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withBalanceAfter(...)
     *   ->withBalanceBefore(...)
     *   ->withCreatedAt(...)
     *   ->withCreditEntitlementID(...)
     *   ->withCustomerID(...)
     *   ->withEntryType(...)
     *   ->withIsCredit(...)
     *   ->withOverageAfter(...)
     *   ->withOverageBefore(...)
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
     * @param LedgerEntryType|value-of<LedgerEntryType> $entryType
     */
    public static function with(
        string $id,
        string $amount,
        string $balanceAfter,
        string $balanceBefore,
        \DateTimeInterface $createdAt,
        string $creditEntitlementID,
        string $customerID,
        LedgerEntryType|string $entryType,
        bool $isCredit,
        string $overageAfter,
        string $overageBefore,
        ?string $grantID = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['balanceAfter'] = $balanceAfter;
        $self['balanceBefore'] = $balanceBefore;
        $self['createdAt'] = $createdAt;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['customerID'] = $customerID;
        $self['entryType'] = $entryType;
        $self['isCredit'] = $isCredit;
        $self['overageAfter'] = $overageAfter;
        $self['overageBefore'] = $overageBefore;

        null !== $grantID && $self['grantID'] = $grantID;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withBalanceAfter(string $balanceAfter): self
    {
        $self = clone $this;
        $self['balanceAfter'] = $balanceAfter;

        return $self;
    }

    public function withBalanceBefore(string $balanceBefore): self
    {
        $self = clone $this;
        $self['balanceBefore'] = $balanceBefore;

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

    /**
     * @param LedgerEntryType|value-of<LedgerEntryType> $entryType
     */
    public function withEntryType(LedgerEntryType|string $entryType): self
    {
        $self = clone $this;
        $self['entryType'] = $entryType;

        return $self;
    }

    public function withIsCredit(bool $isCredit): self
    {
        $self = clone $this;
        $self['isCredit'] = $isCredit;

        return $self;
    }

    public function withOverageAfter(string $overageAfter): self
    {
        $self = clone $this;
        $self['overageAfter'] = $overageAfter;

        return $self;
    }

    public function withOverageBefore(string $overageBefore): self
    {
        $self = clone $this;
        $self['overageBefore'] = $overageBefore;

        return $self;
    }

    public function withGrantID(?string $grantID): self
    {
        $self = clone $this;
        $self['grantID'] = $grantID;

        return $self;
    }

    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
