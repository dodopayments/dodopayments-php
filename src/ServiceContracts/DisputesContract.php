<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;

interface DisputesContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): GetDispute;

    /**
     * @api
     *
     * @param array<mixed>|DisputeListParams $params
     *
     * @return DefaultPageNumberPagination<DisputeListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|DisputeListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;
}
