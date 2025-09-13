<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new LedgerEntryListParams); // set properties as needed
 * $client->customers.wallets.ledgerEntries->list(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->customers.wallets.ledgerEntries->list(...$params->toArray());`
 *
 * @see Dodopayments\Customers\Wallets\LedgerEntries->list
 *
 * @phpstan-type ledger_entry_list_params = array{
 *   currency?: Currency|value-of<Currency>, pageNumber?: int, pageSize?: int
 * }
 */
final class LedgerEntryListParams implements BaseModel
{
    /** @use SdkModel<ledger_entry_list_params> */
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
    public ?int $pageNumber;

    #[Api(optional: true)]
    public ?int $pageSize;

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
        ?int $pageNumber = null,
        ?int $pageSize = null,
    ): self {
        $obj = new self;

        null !== $currency && $obj->currency = $currency instanceof Currency ? $currency->value : $currency;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;

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
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;

        return $obj;
    }

    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->pageNumber = $pageNumber;

        return $obj;
    }

    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->pageSize = $pageSize;

        return $obj;
    }
}
