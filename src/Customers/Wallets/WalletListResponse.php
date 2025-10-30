<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type WalletListResponseShape = array{
 *   items: list<CustomerWallet>, totalBalanceUsd: int
 * }
 */
final class WalletListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<WalletListResponseShape> */
    use SdkModel;

    use SdkResponse;

    /** @var list<CustomerWallet> $items */
    #[Api(list: CustomerWallet::class)]
    public array $items;

    /**
     * Sum of all wallet balances converted to USD (in smallest unit).
     */
    #[Api('total_balance_usd')]
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
     * @param list<CustomerWallet> $items
     */
    public static function with(array $items, int $totalBalanceUsd): self
    {
        $obj = new self;

        $obj->items = $items;
        $obj->totalBalanceUsd = $totalBalanceUsd;

        return $obj;
    }

    /**
     * @param list<CustomerWallet> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    /**
     * Sum of all wallet balances converted to USD (in smallest unit).
     */
    public function withTotalBalanceUsd(int $totalBalanceUsd): self
    {
        $obj = clone $this;
        $obj->totalBalanceUsd = $totalBalanceUsd;

        return $obj;
    }
}
