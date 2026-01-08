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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface DisputesRawContract
{
    /**
     * @api
     *
     * @param string $disputeID Dispute Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GetDispute>
     *
     * @throws APIException
     */
    public function retrieve(
        string $disputeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DisputeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<DisputeListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|DisputeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
