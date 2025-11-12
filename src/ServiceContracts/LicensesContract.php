<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Licenses\LicenseActivateParams;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseDeactivateParams;
use Dodopayments\Licenses\LicenseValidateParams;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;

interface LicensesContract
{
    /**
     * @api
     *
     * @param array<mixed>|LicenseActivateParams $params
     *
     * @throws APIException
     */
    public function activate(
        array|LicenseActivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseActivateResponse;

    /**
     * @api
     *
     * @param array<mixed>|LicenseDeactivateParams $params
     *
     * @throws APIException
     */
    public function deactivate(
        array|LicenseDeactivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|LicenseValidateParams $params
     *
     * @throws APIException
     */
    public function validate(
        array|LicenseValidateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse;
}
