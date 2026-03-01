<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * For credit entries, a new grant is created. For debit entries, credits are
 * deducted from existing grants using FIFO (oldest first).
 *
 * # Authentication
 * Requires an API key with `Editor` role.
 *
 * # Path Parameters
 * - `credit_entitlement_id` - The unique identifier of the credit entitlement
 * - `customer_id` - The unique identifier of the customer
 *
 * # Request Body
 * - `entry_type` - "credit" or "debit"
 * - `amount` - Amount to credit or debit
 * - `reason` - Optional human-readable reason
 * - `expires_at` - Optional expiration for credited amount (only for credit type)
 * - `idempotency_key` - Optional key to prevent duplicate entries
 *
 * # Responses
 * - `201 Created` - Ledger entry created successfully
 * - `400 Bad Request` - Invalid request (e.g., debit with insufficient balance)
 * - `404 Not Found` - Credit entitlement or customer not found
 * - `409 Conflict` - Idempotency key already exists
 * - `500 Internal Server Error` - Database or server error
 *
 * @see Dodopayments\Services\CreditEntitlements\BalancesService::createLedgerEntry()
 *
 * @phpstan-type BalanceCreateLedgerEntryParamsShape = array{
 *   creditEntitlementID: string,
 *   amount: string,
 *   entryType: LedgerEntryType|value-of<LedgerEntryType>,
 *   expiresAt?: \DateTimeInterface|null,
 *   idempotencyKey?: string|null,
 *   metadata?: array<string,string>|null,
 *   reason?: string|null,
 * }
 */
final class BalanceCreateLedgerEntryParams implements BaseModel
{
    /** @use SdkModel<BalanceCreateLedgerEntryParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $creditEntitlementID;

    /**
     * Amount to credit or debit.
     */
    #[Required]
    public string $amount;

    /**
     * Entry type: credit or debit.
     *
     * @var value-of<LedgerEntryType> $entryType
     */
    #[Required('entry_type', enum: LedgerEntryType::class)]
    public string $entryType;

    /**
     * Expiration for credited amount (only for credit type).
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Idempotency key to prevent duplicate entries.
     */
    #[Optional('idempotency_key', nullable: true)]
    public ?string $idempotencyKey;

    /**
     * Optional metadata (max 50 key-value pairs, key max 40 chars, value max 500 chars).
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    /**
     * Human-readable reason for the entry.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * `new BalanceCreateLedgerEntryParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceCreateLedgerEntryParams::with(
     *   creditEntitlementID: ..., amount: ..., entryType: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceCreateLedgerEntryParams)
     *   ->withCreditEntitlementID(...)
     *   ->withAmount(...)
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
     * @param LedgerEntryType|value-of<LedgerEntryType> $entryType
     * @param array<string,string>|null $metadata
     */
    public static function with(
        string $creditEntitlementID,
        string $amount,
        LedgerEntryType|string $entryType,
        ?\DateTimeInterface $expiresAt = null,
        ?string $idempotencyKey = null,
        ?array $metadata = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['amount'] = $amount;
        $self['entryType'] = $entryType;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Amount to credit or debit.
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Entry type: credit or debit.
     *
     * @param LedgerEntryType|value-of<LedgerEntryType> $entryType
     */
    public function withEntryType(LedgerEntryType|string $entryType): self
    {
        $self = clone $this;
        $self['entryType'] = $entryType;

        return $self;
    }

    /**
     * Expiration for credited amount (only for credit type).
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Idempotency key to prevent duplicate entries.
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Optional metadata (max 50 key-value pairs, key max 40 chars, value max 500 chars).
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Human-readable reason for the entry.
     */
    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
