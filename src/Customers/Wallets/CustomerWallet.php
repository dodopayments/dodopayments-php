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
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   customerID: string,
 *   updatedAt: \DateTimeInterface,
 * }
 */
final class CustomerWallet implements BaseModel
{
    /** @use SdkModel<CustomerWalletShape> */
    use SdkModel;

    #[Required]
    public int $balance;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('customer_id')]
    public string $customerID;

    #[Required('updated_at')]
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
        $self = new self;

        $self['balance'] = $balance;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customerID'] = $customerID;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withBalance(int $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
