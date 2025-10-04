<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction\EventType;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type customer_wallet_transaction = array{
 *   id: string,
 *   afterBalance: int,
 *   amount: int,
 *   beforeBalance: int,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customerID: string,
 *   eventType: value-of<EventType>,
 *   isCredit: bool,
 *   reason?: string|null,
 *   referenceObjectID?: string|null,
 * }
 */
final class CustomerWalletTransaction implements BaseModel, ResponseConverter
{
    /** @use SdkModel<customer_wallet_transaction> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $id;

    #[Api('after_balance')]
    public int $afterBalance;

    #[Api]
    public int $amount;

    #[Api('before_balance')]
    public int $beforeBalance;

    #[Api('business_id')]
    public string $businessID;

    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api('customer_id')]
    public string $customerID;

    /** @var value-of<EventType> $eventType */
    #[Api('event_type', enum: EventType::class)]
    public string $eventType;

    #[Api('is_credit')]
    public bool $isCredit;

    #[Api(nullable: true, optional: true)]
    public ?string $reason;

    #[Api('reference_object_id', nullable: true, optional: true)]
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
        $obj = new self;

        $obj->id = $id;
        $obj->afterBalance = $afterBalance;
        $obj->amount = $amount;
        $obj->beforeBalance = $beforeBalance;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj['currency'] = $currency;
        $obj->customerID = $customerID;
        $obj['eventType'] = $eventType;
        $obj->isCredit = $isCredit;

        null !== $reason && $obj->reason = $reason;
        null !== $referenceObjectID && $obj->referenceObjectID = $referenceObjectID;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withAfterBalance(int $afterBalance): self
    {
        $obj = clone $this;
        $obj->afterBalance = $afterBalance;

        return $obj;
    }

    public function withAmount(int $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    public function withBeforeBalance(int $beforeBalance): self
    {
        $obj = clone $this;
        $obj->beforeBalance = $beforeBalance;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

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
        $obj->customerID = $customerID;

        return $obj;
    }

    /**
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $obj = clone $this;
        $obj['eventType'] = $eventType;

        return $obj;
    }

    public function withIsCredit(bool $isCredit): self
    {
        $obj = clone $this;
        $obj->isCredit = $isCredit;

        return $obj;
    }

    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }

    public function withReferenceObjectID(?string $referenceObjectID): self
    {
        $obj = clone $this;
        $obj->referenceObjectID = $referenceObjectID;

        return $obj;
    }
}
