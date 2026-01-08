<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface PayoutsContract
{
    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get payouts created after this time (inclusive)
     * @param \DateTimeInterface $createdAtLte Get payouts created before this time (inclusive)
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<PayoutListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
