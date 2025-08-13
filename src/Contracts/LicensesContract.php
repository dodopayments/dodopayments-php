<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\LicenseKeyInstances\LicenseKeyInstance;
use DodopaymentsClient\Licenses\LicenseActivateParams;
use DodopaymentsClient\Licenses\LicenseDeactivateParams;
use DodopaymentsClient\Licenses\LicenseValidateParams;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Licenses\LicenseValidateResponse;

interface LicensesContract
{
    /**
     * @param array{licenseKey: string, name: string}|LicenseActivateParams $params
     */
    public function activate(
        array|LicenseActivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKeyInstance;

    /**
     * @param array{
     *   licenseKey: string, licenseKeyInstanceID: string
     * }|LicenseDeactivateParams $params
     */
    public function deactivate(
        array|LicenseDeactivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @param array{
     *   licenseKey: string, licenseKeyInstanceID?: null|string
     * }|LicenseValidateParams $params
     */
    public function validate(
        array|LicenseValidateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse;
}
