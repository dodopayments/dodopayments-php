<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;

interface PayoutsContract
{
    /**
     * @api
     *
     * @param string|\DateTimeInterface $createdAtGte Get payouts created after this time (inclusive)
     * @param string|\DateTimeInterface $createdAtLte Get payouts created before this time (inclusive)
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<PayoutListResponse>
     *
     * @throws APIException
     */
    public function list(
        string|\DateTimeInterface|null $createdAtGte = null,
        string|\DateTimeInterface|null $createdAtLte = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
