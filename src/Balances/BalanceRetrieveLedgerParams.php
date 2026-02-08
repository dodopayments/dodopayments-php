<?php

declare(strict_types=1);

namespace Dodopayments\Balances;

use Dodopayments\Balances\BalanceRetrieveLedgerParams\Currency;
use Dodopayments\Balances\BalanceRetrieveLedgerParams\EventType;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\BalancesService::retrieveLedger()
 *
 * @phpstan-type BalanceRetrieveLedgerParamsShape = array{
 *   createdAtGte?: \DateTimeInterface|null,
 *   createdAtLte?: \DateTimeInterface|null,
 *   currency?: null|Currency|value-of<Currency>,
 *   eventType?: null|EventType|value-of<EventType>,
 *   limit?: int|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   referenceObjectID?: string|null,
 * }
 */
final class BalanceRetrieveLedgerParams implements BaseModel
{
    /** @use SdkModel<BalanceRetrieveLedgerParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Get events after this created time.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Get events created before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtLte;

    /**
     * Filter by currency.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Optional(enum: Currency::class)]
    public ?string $currency;

    /**
     * Filter by Ledger Event Type.
     *
     * @var value-of<EventType>|null $eventType
     */
    #[Optional(enum: EventType::class)]
    public ?string $eventType;

    /**
     * Min : 1, Max : 100, default 10.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Page number default is 0.
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Optional]
    public ?int $pageSize;

    /**
     * Get events history of a specific object like payment/subscription/refund/dispute.
     */
    #[Optional]
    public ?string $referenceObjectID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency|value-of<Currency>|null $currency
     * @param EventType|value-of<EventType>|null $eventType
     */
    public static function with(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        Currency|string|null $currency = null,
        EventType|string|null $eventType = null,
        ?int $limit = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $referenceObjectID = null,
    ): self {
        $self = new self;

        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $currency && $self['currency'] = $currency;
        null !== $eventType && $self['eventType'] = $eventType;
        null !== $limit && $self['limit'] = $limit;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $referenceObjectID && $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }

    /**
     * Get events after this created time.
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $self = clone $this;
        $self['createdAtGte'] = $createdAtGte;

        return $self;
    }

    /**
     * Get events created before this time.
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $self = clone $this;
        $self['createdAtLte'] = $createdAtLte;

        return $self;
    }

    /**
     * Filter by currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Filter by Ledger Event Type.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Min : 1, Max : 100, default 10.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Get events history of a specific object like payment/subscription/refund/dispute.
     */
    public function withReferenceObjectID(string $referenceObjectID): self
    {
        $self = clone $this;
        $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }
}
