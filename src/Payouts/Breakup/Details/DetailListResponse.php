<?php

declare(strict_types=1);

namespace Dodopayments\Payouts\Breakup\Details;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Individual balance ledger entry for a payout, with amounts pro-rated into the payout's currency.
 *
 * @phpstan-type DetailListResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   eventType: string,
 *   originalAmount: int,
 *   originalCurrency: string,
 *   payoutCurrencyAmount: int,
 *   usdEquivalentAmount: int,
 *   description?: string|null,
 *   referenceObjectID?: string|null,
 * }
 */
final class DetailListResponse implements BaseModel
{
    /** @use SdkModel<DetailListResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the balance ledger entry.
     */
    #[Required]
    public string $id;

    /**
     * Timestamp when this entry was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The type of balance ledger event (e.g., "payment", "refund", "dispute", "payment_fees").
     */
    #[Required('event_type')]
    public string $eventType;

    /**
     * Original amount in the original currency (in smallest currency unit, e.g., cents).
     */
    #[Required('original_amount')]
    public int $originalAmount;

    /**
     * Original currency as ISO 4217 code (e.g., "USD", "EUR").
     */
    #[Required('original_currency')]
    public string $originalCurrency;

    /**
     * Amount in the payout's currency (in smallest currency unit). Uses cumulative rounding to ensure sum matches payout total exactly.
     */
    #[Required('payout_currency_amount')]
    public int $payoutCurrencyAmount;

    /**
     * USD equivalent of the original amount (in cents).
     */
    #[Required('usd_equivalent_amount')]
    public int $usdEquivalentAmount;

    /**
     * Human-readable description of the transaction.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * ID of the related object (e.g., payment ID, refund ID) if applicable.
     */
    #[Optional('reference_object_id', nullable: true)]
    public ?string $referenceObjectID;

    /**
     * `new DetailListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DetailListResponse::with(
     *   id: ...,
     *   createdAt: ...,
     *   eventType: ...,
     *   originalAmount: ...,
     *   originalCurrency: ...,
     *   payoutCurrencyAmount: ...,
     *   usdEquivalentAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DetailListResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withEventType(...)
     *   ->withOriginalAmount(...)
     *   ->withOriginalCurrency(...)
     *   ->withPayoutCurrencyAmount(...)
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
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        string $eventType,
        int $originalAmount,
        string $originalCurrency,
        int $payoutCurrencyAmount,
        int $usdEquivalentAmount,
        ?string $description = null,
        ?string $referenceObjectID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['eventType'] = $eventType;
        $self['originalAmount'] = $originalAmount;
        $self['originalCurrency'] = $originalCurrency;
        $self['payoutCurrencyAmount'] = $payoutCurrencyAmount;
        $self['usdEquivalentAmount'] = $usdEquivalentAmount;

        null !== $description && $self['description'] = $description;
        null !== $referenceObjectID && $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }

    /**
     * Unique identifier of the balance ledger entry.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Timestamp when this entry was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The type of balance ledger event (e.g., "payment", "refund", "dispute", "payment_fees").
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Original amount in the original currency (in smallest currency unit, e.g., cents).
     */
    public function withOriginalAmount(int $originalAmount): self
    {
        $self = clone $this;
        $self['originalAmount'] = $originalAmount;

        return $self;
    }

    /**
     * Original currency as ISO 4217 code (e.g., "USD", "EUR").
     */
    public function withOriginalCurrency(string $originalCurrency): self
    {
        $self = clone $this;
        $self['originalCurrency'] = $originalCurrency;

        return $self;
    }

    /**
     * Amount in the payout's currency (in smallest currency unit). Uses cumulative rounding to ensure sum matches payout total exactly.
     */
    public function withPayoutCurrencyAmount(int $payoutCurrencyAmount): self
    {
        $self = clone $this;
        $self['payoutCurrencyAmount'] = $payoutCurrencyAmount;

        return $self;
    }

    /**
     * USD equivalent of the original amount (in cents).
     */
    public function withUsdEquivalentAmount(int $usdEquivalentAmount): self
    {
        $self = clone $this;
        $self['usdEquivalentAmount'] = $usdEquivalentAmount;

        return $self;
    }

    /**
     * Human-readable description of the transaction.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * ID of the related object (e.g., payment ID, refund ID) if applicable.
     */
    public function withReferenceObjectID(?string $referenceObjectID): self
    {
        $self = clone $this;
        $self['referenceObjectID'] = $referenceObjectID;

        return $self;
    }
}
