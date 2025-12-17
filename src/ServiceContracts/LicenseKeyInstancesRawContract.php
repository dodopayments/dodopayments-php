<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use Dodopayments\RequestOptions;

interface LicenseKeyInstancesRawContract
{
    /**
     * @api
     *
     * @param string $id License key instance ID
     *
     * @return BaseResponse<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id License key instance ID
     * @param array<string,mixed>|LicenseKeyInstanceUpdateParams $params
     *
     * @return BaseResponse<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyInstanceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LicenseKeyInstanceListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<LicenseKeyInstance>>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyInstanceListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
