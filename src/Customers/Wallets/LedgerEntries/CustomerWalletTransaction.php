<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction\EventType;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type CustomerWalletTransactionShape = array{
 *   id: string,
 *   afterBalance: int,
 *   amount: int,
 *   beforeBalance: int,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   customerID: string,
 *   eventType: EventType|value-of<EventType>,
 *   isCredit: bool,
 *   reason?: string|null,
 *   referenceObjectID?: string|null,
 * }
 */
final class CustomerWalletTransaction implements BaseModel
{
    /** @use SdkModel<CustomerWalletTransactionShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('after_balance')]
    public int $afterBalance;

    #[Required]
    public int $amount;

    #[Required('before_balance')]
    public int $beforeBalance;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('customer_id')]
    public string $customerID;

    /** @var value-of<EventType> $eventType */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    #[Required('is_credit')]
    public bool $isCredit;

    #[Optional(nullable: true)]
    public ?string $reason;

    #[Optional('reference_object_id', nullable: true)]
    public ?string $referenceObjectID;

    /**
     * `new CustomerWalletTransaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerWalletTransaction::with(
     *   id: ...,
     *   afterBalance: ...,
     *   amount: ...,
     *   beforeBalance: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customerID: ...,
     *   eventType: ...,
     *   isCredit: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerWalletTransaction)
     *   ->withID(...)
     *   ->withAfterBalance(...)
     *   ->withAmount(...)
     *   ->withBeforeBalance(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomerID(...)
     *   ->withEventType(...)
     *   ->withIsCredit(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param EventType|value-of<EventType> $eventType
     */
    public static function with(
        string $id,
        int $afterBalance,
        int $amount,
        int $beforeBalance,
        string $businessID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        string $customerID,
        EventType|string $eventType,
        bool $isCredit,
        ?string $reason = null,
        ?string $referenceObjectID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['afterBalance'] = $afterBalance;
        $self['amount'] = $amount;
        $self['beforeBalance'] = $beforeBalance;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customerID'] = $customerID;
        $self['eventType'] = $eventType;
        $self['isCredit'] = $isCredit;

        null !== $reason && $self['reason'] = $reason;
        null !== $referenceObjectID && $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAfterBalance(int $afterBalance): self
    {
        $self = clone $this;
        $self['afterBalance'] = $afterBalance;

        return $self;
    }

    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withBeforeBalance(int $beforeBalance): self
    {
        $self = clone $this;
        $self['beforeBalance'] = $beforeBalance;

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

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    public function withIsCredit(bool $isCredit): self
    {
        $self = clone $this;
        $self['isCredit'] = $isCredit;

        return $self;
    }

    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    public function withReferenceObjectID(?string $referenceObjectID): self
    {
        $self = clone $this;
        $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }
}
