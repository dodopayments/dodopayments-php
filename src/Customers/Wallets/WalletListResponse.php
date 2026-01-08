<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CustomerWalletShape from \Dodopayments\Customers\Wallets\CustomerWallet
 *
 * @phpstan-type WalletListResponseShape = array{
 *   items: list<CustomerWallet|CustomerWalletShape>, totalBalanceUsd: int
 * }
 */
final class WalletListResponse implements BaseModel
{
    /** @use SdkModel<WalletListResponseShape> */
    use SdkModel;

    /** @var list<CustomerWallet> $items */
    #[Required(list: CustomerWallet::class)]
    public array $items;

    /**
     * Sum of all wallet balances converted to USD (in smallest unit).
     */
    #[Required('total_balance_usd')]
    public int $totalBalanceUsd;

    /**
     * `new WalletListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WalletListResponse::with(items: ..., totalBalanceUsd: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WalletListResponse)->withItems(...)->withTotalBalanceUsd(...)
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
     * @param list<CustomerWallet|CustomerWalletShape> $items
     */
    public static function with(array $items, int $totalBalanceUsd): self
    {
        $self = new self;

        $self['items'] = $items;
        $self['totalBalanceUsd'] = $totalBalanceUsd;

        return $self;
    }

    /**
     * @param list<CustomerWallet|CustomerWalletShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Sum of all wallet balances converted to USD (in smallest unit).
     */
    public function withTotalBalanceUsd(int $totalBalanceUsd): self
    {
        $self = clone $this;
        $self['totalBalanceUsd'] = $totalBalanceUsd;

        return $self;
    }
}
