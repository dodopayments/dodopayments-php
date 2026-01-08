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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LicenseKeyInstancesRawContract
{
    /**
     * @api
     *
     * @param string $id License key instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id License key instance ID
     * @param array<string,mixed>|LicenseKeyInstanceUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyInstanceUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LicenseKeyInstanceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<LicenseKeyInstance>>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyInstanceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
