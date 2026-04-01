<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Payouts\Breakup;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\Breakup\Details\DetailListResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface DetailsContract
{
    /**
     * @api
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param int $pageNumber Page number (0-indexed). Default: 0.
     * @param int $pageSize Number of items per page. Default: 10, Max: 100.
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<DetailListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $payoutID,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function downloadCsv(
        string $payoutID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
