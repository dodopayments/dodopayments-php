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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LicensesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LicenseActivateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseActivateResponse>
     *
     * @throws APIException
     */
    public function activate(
        array|LicenseActivateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LicenseDeactivateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deactivate(
        array|LicenseDeactivateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LicenseValidateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseValidateResponse>
     *
     * @throws APIException
     */
    public function validate(
        array|LicenseValidateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
