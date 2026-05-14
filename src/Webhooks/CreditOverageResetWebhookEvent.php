<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;

/**
 * @phpstan-import-type CreditLedgerEntryShape from \Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry
 *
 * @phpstan-type CreditOverageResetWebhookEventShape = array{
 *   businessID: string,
 *   data: CreditLedgerEntry|CreditLedgerEntryShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'credit.overage_reset',
 * }
 */
final class CreditOverageResetWebhookEvent implements BaseModel
{
    /** @use SdkModel<CreditOverageResetWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'credit.overage_reset' $type
     */
    #[Required]
    public string $type = 'credit.overage_reset';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Response for a ledger entry.
     */
    #[Required]
    public CreditLedgerEntry $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new CreditOverageResetWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditOverageResetWebhookEvent::with(businessID: ..., data: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditOverageResetWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
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
     * @param CreditLedgerEntry|CreditLedgerEntryShape $data
     */
    public static function with(
        string $businessID,
        CreditLedgerEntry|array $data,
        \DateTimeInterface $timestamp,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Response for a ledger entry.
     *
     * @param CreditLedgerEntry|CreditLedgerEntryShape $data
     */
    public function withData(CreditLedgerEntry|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The event type.
     *
     * @param 'credit.overage_reset' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
