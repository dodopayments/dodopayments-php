<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Disputes\DisputeListParams;
use Dodopayments\Disputes\DisputeListResponse;
use Dodopayments\Disputes\GetDispute;
use Dodopayments\RequestOptions;

interface DisputesRawContract
{
    /**
     * @api
     *
     * @param string $disputeID Dispute Id
     *
     * @return BaseResponse<GetDispute>
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|DisputeListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<DisputeListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|DisputeListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
