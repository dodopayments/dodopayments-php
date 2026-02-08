<?php

declare(strict_types=1);

namespace Dodopayments\Balances;

use Dodopayments\Balances\BalanceLedgerEntry\EventType;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type BalanceLedgerEntryShape = array{
 *   id: string,
 *   amount: int,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   eventType: EventType|value-of<EventType>,
 *   isCredit: bool,
 *   usdEquivalentAmount: int,
 *   afterBalance?: int|null,
 *   beforeBalance?: int|null,
 *   description?: string|null,
 *   referenceObjectID?: string|null,
 * }
 */
final class BalanceLedgerEntry implements BaseModel
{
    /** @use SdkModel<BalanceLedgerEntryShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $amount;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    /** @var value-of<EventType> $eventType */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    #[Required('is_credit')]
    public bool $isCredit;

    #[Required('usd_equivalent_amount')]
    public int $usdEquivalentAmount;

    #[Optional('after_balance', nullable: true)]
    public ?int $afterBalance;

    #[Optional('before_balance', nullable: true)]
    public ?int $beforeBalance;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('reference_object_id', nullable: true)]
    public ?string $referenceObjectID;

    /**
     * `new BalanceLedgerEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceLedgerEntry::with(
     *   id: ...,
     *   amount: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   eventType: ...,
     *   isCredit: ...,
     *   usdEquivalentAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceLedgerEntry)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withEventType(...)
     *   ->withIsCredit(...)
     *   ->withUsdEquivalentAmount(...)
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
        int $amount,
        string $businessID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        EventType|string $eventType,
        bool $isCredit,
        int $usdEquivalentAmount,
        ?int $afterBalance = null,
        ?int $beforeBalance = null,
        ?string $description = null,
        ?string $referenceObjectID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['eventType'] = $eventType;
        $self['isCredit'] = $isCredit;
        $self['usdEquivalentAmount'] = $usdEquivalentAmount;

        null !== $afterBalance && $self['afterBalance'] = $afterBalance;
        null !== $beforeBalance && $self['beforeBalance'] = $beforeBalance;
        null !== $description && $self['description'] = $description;
        null !== $referenceObjectID && $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

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

    public function withUsdEquivalentAmount(int $usdEquivalentAmount): self
    {
        $self = clone $this;
        $self['usdEquivalentAmount'] = $usdEquivalentAmount;

        return $self;
    }

    public function withAfterBalance(?int $afterBalance): self
    {
        $self = clone $this;
        $self['afterBalance'] = $afterBalance;

        return $self;
    }

    public function withBeforeBalance(?int $beforeBalance): self
    {
        $self = clone $this;
        $self['beforeBalance'] = $beforeBalance;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withReferenceObjectID(?string $referenceObjectID): self
    {
        $self = clone $this;
        $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }
}
