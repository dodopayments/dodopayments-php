<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Services\Customers\Wallets\LedgerEntriesService::list()
 *
 * @phpstan-type LedgerEntryListParamsShape = array{
 *   currency?: Currency|value-of<Currency>, page_number?: int, page_size?: int
 * }
 */
final class LedgerEntryListParams implements BaseModel
{
    /** @use SdkModel<LedgerEntryListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional currency filter.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Api(enum: Currency::class, optional: true)]
    public ?string $currency;

    #[Api(optional: true)]
    public ?int $page_number;

    #[Api(optional: true)]
    public ?int $page_size;

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
        Currency|string|null $currency = null,
        ?int $page_number = null,
        ?int $page_size = null,
    ): self {
        $obj = new self;

        null !== $currency && $obj['currency'] = $currency;
        null !== $page_number && $obj->page_number = $page_number;
        null !== $page_size && $obj->page_size = $page_size;

        return $obj;
    }

    /**
     * Optional currency filter.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->page_number = $pageNumber;

        return $obj;
    }

    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }
}
