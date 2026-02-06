<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Balances\BalanceLedgerEntry;
use Dodopayments\Balances\BalanceRetrieveLedgerParams\Currency;
use Dodopayments\Balances\BalanceRetrieveLedgerParams\EventType;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\BalancesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BalancesService implements BalancesContract
{
    /**
     * @api
     */
    public BalancesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BalancesRawService($client);
    }

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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'currency' => $currency,
                'eventType' => $eventType,
                'limit' => $limit,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'referenceObjectID' => $referenceObjectID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveLedger(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
