<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Wallets\LedgerEntries;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Services\Customers\Wallets\LedgerEntriesService::list()
 *
 * @phpstan-type LedgerEntryListParamsShape = array{
 *   currency?: null|Currency|value-of<Currency>,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
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
    #[Optional(enum: Currency::class)]
    public ?string $currency;

    #[Optional]
    public ?int $pageNumber;

    #[Optional]
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
        $self = new self;

        null !== $currency && $self['currency'] = $currency;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Optional currency filter.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
