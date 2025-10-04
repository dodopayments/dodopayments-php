<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type customer_wallet = array{
 *   balance: int,
 *   createdAt: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customerID: string,
 *   updatedAt: \DateTimeInterface,
 * }
 */
final class CustomerWallet implements BaseModel
{
    /** @use SdkModel<customer_wallet> */
    use SdkModel;

    #[Api]
    public int $balance;

    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api('customer_id')]
    public string $customerID;

    #[Api('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * `new CustomerWallet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerWallet::with(
     *   balance: ..., createdAt: ..., currency: ..., customerID: ..., updatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerWallet)
     *   ->withBalance(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomerID(...)
     *   ->withUpdatedAt(...)
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
     */
    public static function with(
        int $balance,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        string $customerID,
        \DateTimeInterface $updatedAt,
    ): self {
        $obj = new self;

        $obj->balance = $balance;
        $obj->createdAt = $createdAt;
        $obj['currency'] = $currency;
        $obj->customerID = $customerID;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    public function withBalance(int $balance): self
    {
        $obj = clone $this;
        $obj->balance = $balance;

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

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }
}
