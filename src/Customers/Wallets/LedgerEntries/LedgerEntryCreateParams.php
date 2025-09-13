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
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new LedgerEntryCreateParams); // set properties as needed
 * $client->customers.wallets.ledgerEntries->create(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->customers.wallets.ledgerEntries->create(...$params->toArray());`
 *
 * @see Dodopayments\Customers\Wallets\LedgerEntries->create
 *
 * @phpstan-type ledger_entry_create_params = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   entryType: EntryType|value-of<EntryType>,
 *   idempotencyKey?: string|null,
 *   reason?: string|null,
 * }
 */
final class LedgerEntryCreateParams implements BaseModel
{
    /** @use SdkModel<ledger_entry_create_params> */
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
     * @var value-of<EntryType> $entryType
     */
    #[Api('entry_type', enum: EntryType::class)]
    public string $entryType;

    /**
     * Optional idempotency key to prevent duplicate entries.
     */
    #[Api('idempotency_key', nullable: true, optional: true)]
    public ?string $idempotencyKey;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        $obj->amount = $amount;
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;
        $obj->entryType = $entryType instanceof EntryType ? $entryType->value : $entryType;

        null !== $idempotencyKey && $obj->idempotencyKey = $idempotencyKey;
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
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;

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
        $obj->entryType = $entryType instanceof EntryType ? $entryType->value : $entryType;

        return $obj;
    }

    /**
     * Optional idempotency key to prevent duplicate entries.
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $obj = clone $this;
        $obj->idempotencyKey = $idempotencyKey;

        return $obj;
    }

    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }
}
