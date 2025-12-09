<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type CustomerWalletShape = array{
 *   balance: int,
 *   created_at: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer_id: string,
 *   updated_at: \DateTimeInterface,
 * }
 */
final class CustomerWallet implements BaseModel
{
    /** @use SdkModel<CustomerWalletShape> */
    use SdkModel;

    #[Required]
    public int $balance;

    #[Required]
    public \DateTimeInterface $created_at;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public string $customer_id;

    #[Required]
    public \DateTimeInterface $updated_at;

    /**
     * `new CustomerWallet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerWallet::with(
     *   balance: ...,
     *   created_at: ...,
     *   currency: ...,
     *   customer_id: ...,
     *   updated_at: ...,
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
        \DateTimeInterface $created_at,
        Currency|string $currency,
        string $customer_id,
        \DateTimeInterface $updated_at,
    ): self {
        $obj = new self;

        $obj['balance'] = $balance;
        $obj['created_at'] = $created_at;
        $obj['currency'] = $currency;
        $obj['customer_id'] = $customer_id;
        $obj['updated_at'] = $updated_at;

        return $obj;
    }

    public function withBalance(int $balance): self
    {
        $obj = clone $this;
        $obj['balance'] = $balance;

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

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

        return $obj;
    }
}
