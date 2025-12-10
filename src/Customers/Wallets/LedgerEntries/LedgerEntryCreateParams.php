<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams\EntryType;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Services\Customers\Wallets\LedgerEntriesService::create()
 *
 * @phpstan-type LedgerEntryCreateParamsShape = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   entryType: EntryType|value-of<EntryType>,
 *   idempotencyKey?: string|null,
 *   reason?: string|null,
 * }
 */
final class LedgerEntryCreateParams implements BaseModel
{
    /** @use SdkModel<LedgerEntryCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public int $amount;

    /**
     * Currency of the wallet to adjust.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Type of ledger entry - credit or debit.
     *
     * @var value-of<EntryType> $entryType
     */
    #[Required('entry_type', enum: EntryType::class)]
    public string $entryType;

    /**
     * Optional idempotency key to prevent duplicate entries.
     */
    #[Optional('idempotency_key', nullable: true)]
    public ?string $idempotencyKey;

    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * `new LedgerEntryCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LedgerEntryCreateParams::with(amount: ..., currency: ..., entryType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LedgerEntryCreateParams)
     *   ->withAmount(...)
     *   ->withCurrency(...)
     *   ->withEntryType(...)
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
     * @param EntryType|value-of<EntryType> $entryType
     */
    public static function with(
        int $amount,
        Currency|string $currency,
        EntryType|string $entryType,
        ?string $idempotencyKey = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['entryType'] = $entryType;

        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Currency of the wallet to adjust.
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
     * Type of ledger entry - credit or debit.
     *
     * @param EntryType|value-of<EntryType> $entryType
     */
    public function withEntryType(EntryType|string $entryType): self
    {
        $self = clone $this;
        $self['entryType'] = $entryType;

        return $self;
    }

    /**
     * Optional idempotency key to prevent duplicate entries.
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
