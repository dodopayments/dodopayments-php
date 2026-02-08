<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Balances\BalanceLedgerEntry;
use Dodopayments\Balances\BalanceRetrieveLedgerParams\Currency;
use Dodopayments\Balances\BalanceRetrieveLedgerParams\EventType;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface BalancesContract
{
    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param Currency|value-of<Currency> $currency Filter by currency
     * @param EventType|value-of<EventType> $eventType Filter by Ledger Event Type
     * @param int $limit Min : 1, Max : 100, default 10
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $referenceObjectID Get events history of a specific object like payment/subscription/refund/dispute
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<BalanceLedgerEntry>
     *
     * @throws APIException
     */
    public function retrieveLedger(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        Currency|string|null $currency = null,
        EventType|string|null $eventType = null,
        ?int $limit = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $referenceObjectID = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
