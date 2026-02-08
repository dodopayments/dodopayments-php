<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Balances\BalanceLedgerEntry;
use Dodopayments\Balances\BalanceRetrieveLedgerParams;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface BalancesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BalanceRetrieveLedgerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<BalanceLedgerEntry>>
     *
     * @throws APIException
     */
    public function retrieveLedger(
        array|BalanceRetrieveLedgerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
