<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Licenses\LicenseActivateParams;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseDeactivateParams;
use Dodopayments\Licenses\LicenseValidateParams;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;

interface LicensesRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|LicenseActivateParams $params
     *
     * @return BaseResponse<LicenseActivateResponse>
     *
     * @throws APIException
     */
    public function activate(
        array|LicenseActivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|LicenseDeactivateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deactivate(
        array|LicenseDeactivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|LicenseValidateParams $params
     *
     * @return BaseResponse<LicenseValidateResponse>
     *
     * @throws APIException
     */
    public function validate(
        array|LicenseValidateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
