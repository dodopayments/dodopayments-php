<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\CreditLedgerEntry\PayloadType;
use Dodopayments\WebhookEvents\WebhookPayload\Data\CreditLedgerEntry\TransactionType;

/**
 * @phpstan-type CreditLedgerEntryShape = array{
 *   id: string,
 *   amount: string,
 *   balanceAfter: string,
 *   balanceBefore: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   creditEntitlementID: string,
 *   customerID: string,
 *   isCredit: bool,
 *   overageAfter: string,
 *   overageBefore: string,
 *   payloadType: PayloadType|value-of<PayloadType>,
 *   transactionType: TransactionType|value-of<TransactionType>,
 *   description?: string|null,
 *   grantID?: string|null,
 *   referenceID?: string|null,
 *   referenceType?: string|null,
 * }
 */
final class CreditLedgerEntry implements BaseModel
{
    /** @use SdkModel<CreditLedgerEntryShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $amount;

    #[Required('balance_after')]
    public string $balanceAfter;

    #[Required('balance_before')]
    public string $balanceBefore;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('customer_id')]
    public string $customerID;

    #[Required('is_credit')]
    public bool $isCredit;

    #[Required('overage_after')]
    public string $overageAfter;

    #[Required('overage_before')]
    public string $overageBefore;

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /** @var value-of<TransactionType> $transactionType */
    #[Required('transaction_type', enum: TransactionType::class)]
    public string $transactionType;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('grant_id', nullable: true)]
    public ?string $grantID;

    #[Optional('reference_id', nullable: true)]
    public ?string $referenceID;

    #[Optional('reference_type', nullable: true)]
    public ?string $referenceType;

    /**
     * `new CreditLedgerEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditLedgerEntry::with(
     *   id: ...,
     *   amount: ...,
     *   balanceAfter: ...,
     *   balanceBefore: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   creditEntitlementID: ...,
     *   customerID: ...,
     *   isCredit: ...,
     *   overageAfter: ...,
     *   overageBefore: ...,
     *   payloadType: ...,
     *   transactionType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditLedgerEntry)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withBalanceAfter(...)
     *   ->withBalanceBefore(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCreditEntitlementID(...)
     *   ->withCustomerID(...)
     *   ->withIsCredit(...)
     *   ->withOverageAfter(...)
     *   ->withOverageBefore(...)
     *   ->withPayloadType(...)
     *   ->withTransactionType(...)
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
     * @param PayloadType|value-of<PayloadType> $payloadType
     * @param TransactionType|value-of<TransactionType> $transactionType
     */
    public static function with(
        string $id,
        string $amount,
        string $balanceAfter,
        string $balanceBefore,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $creditEntitlementID,
        string $customerID,
        bool $isCredit,
        string $overageAfter,
        string $overageBefore,
        PayloadType|string $payloadType,
        TransactionType|string $transactionType,
        ?string $description = null,
        ?string $grantID = null,
        ?string $referenceID = null,
        ?string $referenceType = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['balanceAfter'] = $balanceAfter;
        $self['balanceBefore'] = $balanceBefore;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['customerID'] = $customerID;
        $self['isCredit'] = $isCredit;
        $self['overageAfter'] = $overageAfter;
        $self['overageBefore'] = $overageBefore;
        $self['payloadType'] = $payloadType;
        $self['transactionType'] = $transactionType;

        null !== $description && $self['description'] = $description;
        null !== $grantID && $self['grantID'] = $grantID;
        null !== $referenceID && $self['referenceID'] = $referenceID;
        null !== $referenceType && $self['referenceType'] = $referenceType;

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

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

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

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }

    /**
     * @param TransactionType|value-of<TransactionType> $transactionType
     */
    public function withTransactionType(
        TransactionType|string $transactionType
    ): self {
        $self = clone $this;
        $self['transactionType'] = $transactionType;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withGrantID(?string $grantID): self
    {
        $self = clone $this;
        $self['grantID'] = $grantID;

        return $self;
    }

    public function withReferenceID(?string $referenceID): self
    {
        $self = clone $this;
        $self['referenceID'] = $referenceID;

        return $self;
    }

    public function withReferenceType(?string $referenceType): self
    {
        $self = clone $this;
        $self['referenceType'] = $referenceType;

        return $self;
    }
}
