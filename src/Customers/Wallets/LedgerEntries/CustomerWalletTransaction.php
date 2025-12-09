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
 *   after_balance: int,
 *   amount: int,
 *   before_balance: int,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer_id: string,
 *   event_type: value-of<EventType>,
 *   is_credit: bool,
 *   reason?: string|null,
 *   reference_object_id?: string|null,
 * }
 */
final class CustomerWalletTransaction implements BaseModel
{
    /** @use SdkModel<CustomerWalletTransactionShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $after_balance;

    #[Required]
    public int $amount;

    #[Required]
    public int $before_balance;

    #[Required]
    public string $business_id;

    #[Required]
    public \DateTimeInterface $created_at;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public string $customer_id;

    /** @var value-of<EventType> $event_type */
    #[Required(enum: EventType::class)]
    public string $event_type;

    #[Required]
    public bool $is_credit;

    #[Optional(nullable: true)]
    public ?string $reason;

    #[Optional(nullable: true)]
    public ?string $reference_object_id;

    /**
     * `new CustomerWalletTransaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerWalletTransaction::with(
     *   id: ...,
     *   after_balance: ...,
     *   amount: ...,
     *   before_balance: ...,
     *   business_id: ...,
     *   created_at: ...,
     *   currency: ...,
     *   customer_id: ...,
     *   event_type: ...,
     *   is_credit: ...,
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
     * @param EventType|value-of<EventType> $event_type
     */
    public static function with(
        string $id,
        int $after_balance,
        int $amount,
        int $before_balance,
        string $business_id,
        \DateTimeInterface $created_at,
        Currency|string $currency,
        string $customer_id,
        EventType|string $event_type,
        bool $is_credit,
        ?string $reason = null,
        ?string $reference_object_id = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['after_balance'] = $after_balance;
        $obj['amount'] = $amount;
        $obj['before_balance'] = $before_balance;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['currency'] = $currency;
        $obj['customer_id'] = $customer_id;
        $obj['event_type'] = $event_type;
        $obj['is_credit'] = $is_credit;

        null !== $reason && $obj['reason'] = $reason;
        null !== $reference_object_id && $obj['reference_object_id'] = $reference_object_id;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withAfterBalance(int $afterBalance): self
    {
        $obj = clone $this;
        $obj['after_balance'] = $afterBalance;

        return $obj;
    }

    public function withAmount(int $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    public function withBeforeBalance(int $beforeBalance): self
    {
        $obj = clone $this;
        $obj['before_balance'] = $beforeBalance;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customer_id'] = $customerID;

        return $obj;
    }

    /**
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $obj = clone $this;
        $obj['event_type'] = $eventType;

        return $obj;
    }

    public function withIsCredit(bool $isCredit): self
    {
        $obj = clone $this;
        $obj['is_credit'] = $isCredit;

        return $obj;
    }

    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }

    public function withReferenceObjectID(?string $referenceObjectID): self
    {
        $obj = clone $this;
        $obj['reference_object_id'] = $referenceObjectID;

        return $obj;
    }
}
