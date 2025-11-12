<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams\EntryType;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Customers\Wallets\LedgerEntries->create
 *
 * @phpstan-type LedgerEntryCreateParamsShape = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   entry_type: EntryType|value-of<EntryType>,
 *   idempotency_key?: string|null,
 *   reason?: string|null,
 * }
 */
final class LedgerEntryCreateParams implements BaseModel
{
    /** @use SdkModel<LedgerEntryCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public int $amount;

    /**
     * Currency of the wallet to adjust.
     *
     * @var value-of<Currency> $currency
     */
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * Type of ledger entry - credit or debit.
     *
     * @var value-of<EntryType> $entry_type
     */
    #[Api(enum: EntryType::class)]
    public string $entry_type;

    /**
     * Optional idempotency key to prevent duplicate entries.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $idempotency_key;

    #[Api(nullable: true, optional: true)]
    public ?string $reason;

    /**
     * `new LedgerEntryCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LedgerEntryCreateParams::with(amount: ..., currency: ..., entry_type: ...)
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
     * @param EntryType|value-of<EntryType> $entry_type
     */
    public static function with(
        int $amount,
        Currency|string $currency,
        EntryType|string $entry_type,
        ?string $idempotency_key = null,
        ?string $reason = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj['currency'] = $currency;
        $obj['entry_type'] = $entry_type;

        null !== $idempotency_key && $obj->idempotency_key = $idempotency_key;
        null !== $reason && $obj->reason = $reason;

        return $obj;
    }

    public function withAmount(int $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * Currency of the wallet to adjust.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * Type of ledger entry - credit or debit.
     *
     * @param EntryType|value-of<EntryType> $entryType
     */
    public function withEntryType(EntryType|string $entryType): self
    {
        $obj = clone $this;
        $obj['entry_type'] = $entryType;

        return $obj;
    }

    /**
     * Optional idempotency key to prevent duplicate entries.
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $obj = clone $this;
        $obj->idempotency_key = $idempotencyKey;

        return $obj;
    }

    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }
}
