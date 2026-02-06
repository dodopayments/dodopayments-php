<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Balances\BalanceLedgerEntry;
use Dodopayments\Balances\BalanceRetrieveLedgerParams;
use Dodopayments\Balances\BalanceRetrieveLedgerParams\Currency;
use Dodopayments\Balances\BalanceRetrieveLedgerParams\EventType;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\BalancesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BalancesRawService implements BalancesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   currency?: value-of<Currency>,
     *   eventType?: value-of<EventType>,
     *   limit?: int,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   referenceObjectID?: string,
     * }|BalanceRetrieveLedgerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<BalanceLedgerEntry>>
     *
     * @throws APIException
     */
    public function retrieveLedger(
        array|BalanceRetrieveLedgerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BalanceRetrieveLedgerParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'balances/ledger',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'eventType' => 'event_type',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'referenceObjectID' => 'reference_object_id',
                ],
            ),
            options: $options,
            convert: BalanceLedgerEntry::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
